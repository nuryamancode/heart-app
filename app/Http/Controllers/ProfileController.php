<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    protected $callresponse;
    public function __construct(ResponseController $response)
    {
        $this->callresponse = $response;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('user.profile', [
            'user' => User::find(Auth::user()->id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        //
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'no_bpjs' => $request->no_bpjs
        ]);

        Alert::success('Success', 'Profile updated successfully');
        return redirect()->to('/profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // Admin
    public function profileAdmin()
    {
        return view('admin.page.ganti-password');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Memeriksa password lama yang dimasukkan
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        // Update password
        User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        Alert::success('Success', 'Password Berhasil Diubah');
        return redirect()->back();
    }

    public function updateProfile(Request $request, $id)
    {
        \Log::info($id);
        $user = User::find($id);
        // dd($user);
        if (!$user) {
            return $this->callresponse->response(
                'User tidak ditemukan',
                null,
                false,
            );
        }
        \Log::info($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'name' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'email.email' => 'Email harus memiliki format yang benar.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau svg.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->callresponse->response(
                $errors[0],
                null,
                false,
            );
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->no_hp = $request->no_hp;
        $user->no_bpjs = $request->no_bpjs;

        // Handle image upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $name = time() . '.' . $foto->getClientOriginalExtension();
            $nameFile = $foto->move(public_path('images/profile'), $name);
            $user->foto = $nameFile;
            $user->foto = asset('images/profile/' . $name);
        }

        $user->save();
        return $this->callresponse->response(
            'Foto berhasil diubah',
            $user,
            true,
        );
    }

    public function updatePasswordApi(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->callresponse->response(
                $errors[0],
                null,
                false,
            );
        }

        // Find the user by the provided ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
                'success' => false,
            ], 404);
        }

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->callresponse->response(
                'Password lama salah.',
                null,
                false
            );
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return $this->callresponse->response(
            'Password berhasil diubah.',
            null,
            true
        );
    }
}
