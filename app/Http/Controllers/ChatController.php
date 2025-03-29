<?php

namespace App\Http\Controllers;

use App\Events\ChatSen;
use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\SendAdminMessage;
use App\Events\SendSellerMessage;
use App\Events\SendUserMessage;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{

    protected $callresponse;

    public function __construct(ResponseController $respone)
    {
        $this->callresponse = $respone;
    }

    public function index()
    {
        return view('user.chat-admin');
    }




    public function fetchMessagesFromUserToAdmin(Request $request)
    {
        // Validate the request, ensure receiver_id is passed
        $validator = Validator::make(
            $request->all(),
            [
                'receiver_id' => 'required|exists:users,id',
            ],
            [
                'receiver_id.required' => 'ID admin wajib diisi.',
                'receiver_id.exists' => 'ID admin tidak valid.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->callresponse->response(
                $errors[0],
                null,
                false,
            );
        }

        $receiverId = $request->input('receiver_id');  // ID admin to fetch messages for
        $senderId = Auth::user()->id; // Get sender ID from authentication

        // Fetch the chat messages between the user and the admin
        $messages = Chat::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Return the chat messages as a response
        return response()->json([
            'status' => true,
            'message' => 'Pesan berhasil diambil!',
            'data' => $messages,
        ]);
    }



    public function sendMessageFromUserToAdmin(Request $request)
    {
        // Validasi data yang diterima dari pengguna
        $validator = Validator::make(
            $request->all(),
            [
                'message' => 'required|string',
                'receiver_id' => 'required|exists:users,id',
            ],
            [
                'message.required' => 'Pesan wajib diisi.',
                'receiver_id.required' => 'ID admin wajib diisi.',
                'receiver_id.exists' => 'ID admin tidak valid.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->callresponse->response(
                $errors[0],
                null,
                false,
            );
        }

        // Ambil data pesan dan receiver_id
        $message = $request->input('message');
        $receiverId = $request->input('receiver_id');  // ID admin yang ingin dituju (disesuaikan dengan kebutuhan)
        // $senderId = $request->input('sender_id'); // Ambil ID pengirim dari autentikasi
        $senderId = Auth::user()->id; // Ambil ID pengirim dari autentikasi
        \Log::debug('Sender ID: ' . $senderId);
        // Simpan pesan ke database
        $chat = new Chat();
        $chat->sender_id = $senderId;
        $chat->receiver_id = $receiverId;
        $chat->message = $message;
        $chat->seen = false; // Pesan baru, belum terbaca
        $chat->save();

        // event(new ChatSen($chat, $receiverId, auth()->id()));

        // Mengembalikan respons API dalam format JSON
        return response()->json([
            'status' => true,
            'message' => 'Pesan berhasil dikirim!',
            'data' => [
                'message' => $chat->message,
                'sender_id' => $chat->sender_id,
                'receiver_id' => $chat->receiver_id,
                'created_at' => $chat->created_at->format('h:i A'),
            ]
        ]);
    }






    public function indexAdmin()
    {
        // Mengambil pengguna yang telah mengirim setidaknya satu pesan
        $users = User::with([
            'send' => function ($query) {
                $query->latest()->first(); // Mengambil pesan terakhir dari pengguna
            }
        ])
            ->whereHas('send') // Pastikan bahwa pengguna telah mengirim pesan
            ->whereNot('id', Auth::user()->id) // Mengecualikan pengguna admin yang sedang login
            ->get();

        return view('admin.page.chat', compact('users'));
    }
    public function chatRoom($id)
    {
        // Mengambil pengguna yang telah mengirim setidaknya satu pesan
        $users = User::with([
            'send' => function ($query) {
                // Ambil pesan terakhir yang dikirim oleh pengguna
                $query->latest()->get();
            }
        ])
            ->whereHas('send') // Pastikan pengguna memiliki pesan terkirim
            ->whereNot('id', Auth::user()->id) // Mengecualikan admin yang sedang login
            ->get();

        $chat = Chat::where('sender_id', $id)->orWhere('receiver_id', $id)->get();
        $data = [
            'users' => $users,
            'chat' => $chat
        ];
        // Menampilkan halaman dengan data pengguna yang memiliki pesan
        return view('admin.page.room-chat', $data);
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $sender_id = Auth::id();
        $receiver_id = $request->input('receiver_id');
        $message_content = $request->input('message');

        $message = Chat::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message_content,
            'seen' => false,
            'created_at' => now(), // Pastikan waktu tersimpan dengan benar
        ]);

        $message->formatted_time = $message->created_at->format('h:i A');

        // event(new ChatSen($message, $receiver_id ,auth()->id()));

        return response()->json([
            'success' => true,
            'message' => $message->message,
            'created_at' => $message->created_at->toISOString(), // Kirim dalam format ISO 8601
            'formatted_time' => $message->formatted_time,
        ]);
    }



    public function fetchMessages(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $messages = Chat::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $receiverId)
                ->orWhere('sender_id', $receiverId)->where('receiver_id', Auth::id());
        })
            ->orderBy('created_at', 'ASC') // Urutkan dari yang terlama ke terbaru
            ->get();

        // Format waktu agar sama dengan yang ada di Blade
        foreach ($messages as $message) {
            $message->formatted_time = $message->created_at->format('h:i A');
        }

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
