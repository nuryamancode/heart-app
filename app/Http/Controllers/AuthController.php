<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterStoreRequest $request)
    {
        //
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'no_bpjs' => $request->no_bpjs,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login');
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
    public function destroy()
    {
        //
        Auth::logout();
        return redirect('/login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus memiliki format yang benar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus memiliki minimal :min karakter.',
        ]);


        // Lanjutkan proses login jika Captcha valid
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function login_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus memiliki format yang benar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus memiliki minimal :min karakter.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->callresponse->response(
                $errors[0],
                null,
                false,
            );
        }

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('API Token')->plainTextToken;

            return $this->callresponse->response(
                'Login berhasil',
                [
                    'user' => $user->toArray(),
                    'token' => $token
                ],
                true
            );
        }

        return $this->callresponse->response(
            'Email atau password salah.',
            null,
            false
        );
    }

    public function register_api(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'nik' => 'required|unique:users',
                'no_hp' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'nik.required' => 'NIK wajib diisi.',
                'no_hp.required' => 'No HP wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Email harus memiliki format yang benar.',
                'email.unique' => 'Email sudah terdaftar.',
                'nik.unique' => 'NIK sudah terdaftar.',
                'password.required' => 'Kata sandi wajib diisi.',
                'password.min' => 'Kata sandi harus memiliki minimal :min karakter.',
                'password_confirmation.required' => 'Konfirmasi kata sandi wajib diisi.',
                'password_confirmation.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi.',
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

        if (User::where('email', $request->email)->exists()) {
            return $this->callresponse->response(
                'Email sudah terdaftar',
                null,
                false
            );
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'no_bpjs' => $request->no_bpjs,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return $this->callresponse->response(
                'Registrasi gagal',
                null,
                false
            );
        } else {
            return $this->callresponse->response(
                'Registrasi berhasil',
                $user->toArray(),
                true
            );
        }


    }
}
