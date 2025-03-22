<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->char('nik')->unique();
        //     $table->string('no_hp');
        //     $table->char('no_bpjs')->unique()->nullable();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->enum('role', ['admin', 'user'])->default('user');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
        return [
            //
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nik' => ['required', 'min:16', 'max:16', 'unique:users,nik'],
            'no_hp' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }
}
