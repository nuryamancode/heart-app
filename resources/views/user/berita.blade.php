@extends('user.components.base', ['title' => 'Berita'])
@section('content')
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
    <!-- Homepage2 Details Section Start -->
    <section id="test-sec">
        <div class="homepage2-fourth-sec mt-24">
            <div class="container">
                <div class="notification-page-full mt-24">
                    <h1 class="d-none">Notification Page</h1>
                    {{--  Foreach  --}}
                    @foreach ($artikel as $item)
                        <a href="{{ route('detail-berita', $item->id) }}">
                            <div class="notification-page-sec">
                                <div class="notification-img">
                                    <img src="{{ asset('/images/artikel/' . $item->foto) }}" alt="notification-img">
                                </div>
                                <div class="notification-content">
                                    <h3 class="noti-title">{{ $item->judul }}</h3>
                                    <p class="noti-desc">{{ $item->isi }}</p>
                                    <p class="noti-subtitle mt-8">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{--  Foreach  --}}
                </div>
            </div>
        </div>
    </section>
@endsection
