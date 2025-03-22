@extends('user.components.base', ['title' => 'Test Result'])
@section('content')
    <section id="payment-success-first" class="{{ $test->score >= 12 ? 'bg-red' : 'bg-green' }}">
        <div class="payment-success-first-wrap">
            <img src="{{ asset('assets/images/payment-success/bg-img.png') }}" class="img-fluid" alt="bg-img">
            <div class="payment-logo-sec">
                <img src="{{ asset('assets/image-new/icon/doctor.svg') }}" alt="success-img">
            </div>
        </div>
        <div class="payment-success-second-wrapper" style="padding-bottom: 20px">
            <div class="container">
                <div class="payment-success-second">
                    <div class="container">
                        <div class="payment-success-second-wrap">
                            <h1 class="success-title">{{ $test->score }}<span>pt</span></h1>
                            <h1 class="success-title-risk"> {{ $test->score >= 12 ? 'High Risk' : 'Low Risk' }}!</h1>
                            <div class="success-img mt-24">
                            </div>
                            <p class="success-para">
                                {{ $test->score >= 12 ? 'Resiko tinggi. Segera dilakukan perawatan di Rumah Sakit.' : 'Resiko rendah. Tidak perlu dilakukan perawatan di Rumah Sakit.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Backtohome">
            <a href="{{ route('test-detail') }}" class="detail mb-3">Lihat Detail</a>
            <a href="{{ route('test-page') }}" class="test-again">Test Ulang</a>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .bg-green {
            background-color: #00930c !important;
        }

        .bg-red {
            background-color: #F90965 !important;
        }
    </style>
@endsection
