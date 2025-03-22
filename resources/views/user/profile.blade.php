@extends('user.components.base', ['title' => 'Profile'])
@section('content')
    <header class="top-navbar">
        <div class="container">
            <div class="top-navbar_full">
                <div class="menu-btn d-flex align-items-center">
                </div>
                <div class="brookwood-txt d-flex align-items-center">
                    <p class="brookwood-txt">Health App</p>
                </div>
            </div>
        </div>
        <div class="navbar-boder"></div>
    </header>
    <!-- Header Section End -->
    <!-- Profile Details Section Start -->
    <section id="profile-page-sec">
        <div class="profile-top-sec">
            <div class="profile-top-sec-full">
                <div class="profile-img-sec">
                    <label for="upload-photo">
                        <div class="profile-img-box">
                            <img id="profile-img" class="profile-img"
                                src="{{ asset('assets/images/profile-page/profile-1.png') }}" alt="profile-img">
                        </div>
                        <div class="gallay-icon">
                            <img src="assets/images/profile-page/gallary-icon.svg" alt="gallery-icon">
                        </div>
                    </label>
                    <input type="file" id="upload-photo" style="display: none;" accept="image/*"
                        onchange="loadFile(event)">
                </div>

                <div class="profile-details-sec">
                    <h3 class="pro-txt1">{{ $user->name }}</h3>
                    <h4 class="pro-txt2">{{ $user->email }}</h4>
                    <h5 class="pro-txt3">{{ $user->no_hp }}</h5>
                    <div class="btn-logout">
                        <a href="{{ route('logout') }}">
                            <span class="me-2 mt-1">Logout</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-power" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1z" />
                                <path
                                    d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="profile-second-sec">
            <div class="container">
                <form action="" method="POST">
                    @csrf
                    <div class="profile-second-sec">
                        <div class="form-sec mb-3">
                            <label class="txt-lbl">NIK</label><br>
                            <input type="nik" id="nik" name="nik" placeholder="NIK in here" class="txt-input"
                                value="{{ $user->nik }}">
                            <div class="form_bottom_boder"></div>
                            @error('nik')
                                <div class="form_bottom_boder text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-second-sec">
                        <div class="form-sec mb-3">
                            <label class="txt-lbl">Nama Lengkap</label><br>
                            <input type="name" id="name" name="name" placeholder="Name in here" class="txt-input"
                                value="{{ $user->name }}">
                            <div class="form_bottom_boder"></div>
                            @error('name')
                                <div class="form_bottom_boder text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-second-sec">
                        <div class="form-sec mb-3">
                            <label class="txt-lbl">No Telepon</label><br>
                            <input type="no_telepon" id="no_telepon" name="no_hp" placeholder="No Telepon in here"
                                class="txt-input" value="{{ $user->no_hp }}">
                            <div class="form_bottom_boder"></div>
                            @error('no_hp')
                                <div class="form_bottom_boder text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-second-sec">
                        <div class="form-sec mb-3">
                            <label class="txt-lbl">Email</label><br>
                            <input type="email" id="email" name="email" placeholder="Email in here"
                                value="{{ $user->email }}" class="txt-input">
                            <div class="form_bottom_boder"></div>
                            @error('email')
                                <div class="form_bottom_boder text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- If Else -->
                    <div class="profile-second-sec">
                        <div class="form-sec mb-3">
                            <label class="txt-lbl">Nomor BPJS</label><br>
                            <input type="text" inputmode="numeric" id="no_bpjs" name="no_bpjs"
                                value="{{ $user->no_bpjs }}" placeholder="Nomor BPJS in here" class="txt-input">
                            <div class="form_bottom_boder"></div>
                        </div>
                    </div>
                    <!-- If Else -->
                    <div class="sign-in">
                        <button type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function loadFile(event) {
            var profileImg = document.getElementById('profile-img');
            profileImg.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
