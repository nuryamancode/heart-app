@extends('user.components.base', ['title' => 'Detail Berita'])
@section('content')
    <!-- Header Section Start -->
    <header id="top-navbar" class="top-navbar">
        <div class="container">
            <div class="top-navbar_full">
                <div class="back-btn d-flex align-items-center">
                    <a href="javascript: history.go(-1)">
                        <img src="{{ asset('assets/images/forget-password-screen/back-btn.svg') }}" alt="back-btn-img">
                    </a>
                </div>
                <div class="top-navbar-title d-flex align-items-center">
                    <p>Health App</p>
                </div>
            </div>
        </div>
        <div class="navbar-boder"></div>
    </header>
    <!-- Header Section End -->
    <!--Homepage1 Section Start -->
    <section id="homepage1-sec">
        <div class="homepage-fifth-sec">
            <div class="container">
                <div class="img-item-sec">
                    <div class="img-news mt-4">
                        <img src="{{ asset('/images/artikel/' . $artikel->foto) }}" alt="">
                    </div>
                    <div class="content-desc mt-3">
                        <h1 class="mb-2">{{ $artikel->judul }}</h1>
                        <p>{{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}</p>
                        <h6>
                            {{ $artikel->isi  }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Homepage1 Section End -->
@endsection
