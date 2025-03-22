<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\SendAdminMessage;
use App\Events\SendSellerMessage;
use App\Events\SendUserMessage;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('user.chat-admin');
    }
    public function indexAdmin()
    {
        $users = User::with([
            'send' => function ($query) {
                $query->latest()->first(); // Ambil pesan terakhir dari user
            }
        ])->where('role', 'user')->get();
        return view('admin.page.chat', compact('users'));
    }
    public function fetchMessagesFromUserToAdmin(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);
        $receiverId = $request->input('receiver_id');
        $sellerId = Auth::user()->id;

        $messages = Chat::where(function ($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $sellerId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $sellerId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function sendMessageFromUserToAdmin(Request $request)
    {

        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id', // Sesuaikan dengan tabel admin
        ]);

        $message = $request->input('message');
        $receiverId = 1;
        $senderId = Auth::id();


        $chat = new Chat();
        $chat->sender_id = $senderId;
        $chat->receiver_id = $receiverId;
        $chat->message = $message;
        $chat->seen = 0; // Belum terbaca
        $chat->save();

        broadcast(new SendUserMessage($message, $senderId, $receiverId))->toOthers();

        return response()->json(['success' => true, 'message' => 'Pesan terkirim']);
    }







    public function sendMessage(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id', // Pastikan penerima ada dalam database
        ]);

        // Ambil ID pengirim dan penerima
        $sender_id = Auth::id();
        $receiver_id = $request->input('receiver_id');
        $message_content = $request->input('message');

        // Simpan pesan ke dalam database
        $message = Chat::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message_content,
            'seen' => false, // Pesan baru belum terbaca
        ]);

        // Kirimkan event ke Pusher untuk notifikasi pesan
        broadcast(new SendAdminMessage($message, $sender_id, $receiver_id))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message->message,
            'created_at' => $message->created_at->format('h:i A'),
        ]);
    }
    public function fetchMessages(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $messages = Chat::where('sender_id', $receiverId)
            ->orWhere('receiver_id', $receiverId)
            ->orderBy('created_at', 'ASC') // Urutkan dari yang terlama ke terbaru
            ->get();

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function markMessagesAsSeen($receiverId)
    {
        // Update pesan yang diterima oleh pengguna dan belum terbaca
        Chat::where('sender_id', $receiverId)
            ->where('seen', false)
            ->update(['seen' => true]);

        return response()->json(['success' => true]);
    }

}
