@extends('user.components.base', ['title' => 'Riwayat'])
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
    <section id="test-sec">
        <div class="homepage2-third-sec mt-24">
            <div class="container">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button custom_icon collapsed mb-3" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Riwayat Antrian
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="">
                                <div class="serachbar-homepage2 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text search-iconn">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z"
                                                    fill="#7D8FAB"></path>
                                            </svg>
                                        </span>
                                        <input type="text" placeholder="Cari Riwayat Antrian"
                                            class="form-control search-text">
                                    </div>
                                </div>
                                <div class="antrian-sec mb-3">
                                    {{--  Foreach  --}}
                                    <div class="antrian-sec-slide-full">
                                        <div class="antrian-img-sec">
                                            <img src="{{ asset('assets/image-new/number.jpg') }}" alt="">
                                        </div>
                                        <div class="antrian-content-sec">
                                            <div class="antrian-content-sec-full">
                                                <h3 class="slider-pro-title-nomor-antrian text-center mt-2">Antrian
                                                </h3>
                                                <h3 class="slider-pro-title-nomor-antrian text-center">Nomor 1</h3>
                                                <div class="btn-antrian-success">
                                                    <p class="text-dark">Antrian Kamu</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  Foreach  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item"style="margin-bottom: 20%;">
                        <h2 class="accordion-header">
                            <button class="accordion-button custom_icon collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Riwayat Test
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="">
                                <div class="serachbar-homepage2 mb-3 mt-4">
                                    <div class="input-group">
                                        <span class="input-group-text search-iconn">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z"
                                                    fill="#7D8FAB"></path>
                                            </svg>
                                        </span>
                                        <input type="text" placeholder="Cari Riwayat Test"
                                            class="form-control search-text">
                                    </div>
                                </div>
                                @foreach ($tests as $test)
                                    <a href="{{ route('test-detail') }}">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="text-start">
                                                            <p
                                                                class="test-title-{{ $test->score >= 12 ? 'danger' : 'safe' }}">
                                                                {{ $test->score }}<span>pt</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div
                                                                class="score-{{ $test->score >= 12 ? 'danger' : 'safe' }} me-2">
                                                            </div>
                                                            <p class="test-subtitle">
                                                                {{ $test->score >= 12 ? 'High Risk' : 'Low Risk' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-end">
                                                            <p class="test-subtitle-date">
                                                                {{ date('d F Y', strtotime($test->created_at)) }}</p>
                                                            <p class="test-subtitle-date">
                                                                {{ date('H:i', strtotime($test->created_at)) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
