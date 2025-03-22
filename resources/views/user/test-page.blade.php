@extends('user.components.base', ['title' => 'Test'])
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

    <!-- Homepage2 Details Section Start -->
    <section id="test-sec" style="background-color: #5FC613; margin-bottom: -10px">
        <div class="test-first-sec">
            <div class="tutorial-text">
                <h1 class="tutorial-title">Yuk, Jawab beberapa pertanyaan berikut dan sebelumnya simak terlebih dahulu video
                    nya agar dapat memahami cara pengisian
                </h1>
                <p class="tutorial-para">
                    Dengan melanjutkan berarti anda dapat menyetujui syarat dan ketentuan.
                </p>
            </div>
            <div class="tutorial-test">
                <video controls autoplay loop>
                    <source src="{{ asset('video/' . $video->video) }}" type="video/mp4">
                </video>
            </div>
            <div class="tutorial-btn">
                <a href="{{ route('start') }}">Mulai</a>
            </div>
        </div>

        <div class="test-char">
            <img src="{{ asset('assets/image-new/ilustrasi/ilustrasi-test-3.png') }}" alt="">
        </div>
    </section>
    <!-- Homepage2 Details Section End -->
@endsection
