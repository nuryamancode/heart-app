@extends('components.layout', ['title' => 'Heart App - Login'])

@section('content')
    <section id="sign-in-screen" class="mt-5">
        <div class="logo-img">
            <img src="assets/image-new/logo-heart.png" width="200" alt="">
        </div>
        <div class="container">
            <div class="sign-in-screen_full">
                <div class="sign-in-screen-top">
                    <h1 class="text-center">Panel Administrator Test</h1>
                    <form class="sign-in-form mt-16" action="/login" method="post" novalidate>
                        @csrf
                        <div class="form-sec">
                            <label class="txt-lbl">Email</label><br>
                            <input type="email" id="email" name="email" placeholder="Email Anda" class="txt-input">
                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-sec mt-3">
                            <label class="txt-lbl">Password</label><br>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" placeholder="Password Anda"
                                    class="txt-input">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" id="showPassword" type="checkbox" value=""
                                        onchange="togglePasswordVisibility()">
                                    <label class="form-check-label" for="showPassword">
                                        Lihat Password
                                    </label>
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>


                        <div class="sign-in mt-32">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        /**
         * Fungsi untuk mengubah visibility password.
         */
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');

            if (showPasswordCheckbox.checked) {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        }
    </script>
@endsection
