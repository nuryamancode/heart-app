@extends('auth.onboarding.layout', ['title' => 'Heart App - OnScreen'])

@section('content')
    <div class="container Onboarding-Screen-1-full">
        <div class="main-header">
        </div>
        <div class="skip_btn_1 skip_btn">
            <a href="{{ route('login') }}" class="btn btn-secondary">Skip</a>
        </div>
        <div class="img">
            <img src="{{ asset('assets/image-new/ilustrasi/ilustrasi-2.png') }}" style="width: 100%;" alt="">
        </div>
        <div class="screen-1-content">
            <h1>Track Your Heartbeat</h1>
            <p>Easily monitor your heart rate and keep a record of your daily measurements.</p>
        </div>
        <div class="d-flex justify-content-evenly align-items-center" style="margin-top: 60px;">
            <div class="btn-1 mb-3">
                <a href="{{ route('on-screen-1') }}" class=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                    Back
                </a>
            </div>
            <div class="btn-1 mb-3">
                <a href="{{ route('on-screen-3') }}">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection
