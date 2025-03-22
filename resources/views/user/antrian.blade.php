@extends('user.components.base', ['title' => 'Antrian'])
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
                <h3 class="slider-pro-title-antrian text-center text-uppercase mb-3">Antrian</h3>
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
                        <input type="text" placeholder="Cari Antrian" class="form-control search-text">
                    </div>
                </div>
                <div class="antrian-sec">
                    @foreach ($antrian as $antrians)
                        <div class="antrian-sec-slide-full">
                            <div class="antrian-img-sec">
                                <img src="{{ asset('images/number/' . $antrians->foto) }}" alt="">
                            </div>
                            <div class="antrian-content-sec">
                                <div class="antrian-content-sec-full">
                                    <h3 class="slider-pro-title-nomor-antrian text-center mt-2">Antrian</h3>
                                    <h3 class="slider-pro-title-nomor-antrian text-center">Nomor {{ $antrians->no_antrian }}
                                    </h3>
                                    <div class="btn-antrian">
                                        <a class="btn-antrian-btn" href="#">Ambil Antrian</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="homepage2-third-sec mt-24">
            <div class="container">
                <h3 class="slider-pro-title-antrian text-center text-uppercase mb-3 mt-5">Jadwal Dokter</h3>
                <div class="prodcut-sec-slide">
                    @foreach ($jadwal as $jadwals)
                        <div class="prodcut-sec-slide-full">
                            <div class="slider-img-sec">
                                <img src="{{ asset('images/dokter/' . $jadwals->foto) }}" alt="">
                            </div>
                            <div class="slider-content-sec">
                                <div class="slider-content-sec-full">
                                    <h3 class="slider-pro-title">Dr. {{ $jadwals->nama_dokter }}</h3>
                                    <div class="status mt-2">
                                        <div class="d-flex justify-content-start align-items-center">
                                            @if ($jadwals->sibuk == 1)
                                                @if ($jadwals->kosong == 1)
                                                    <div class="sibuk me-2"></div>
                                                    <div class="kosong me-2"></div>
                                                @else
                                                    <div class="sibuk me-2"></div>
                                                @endif
                                            @elseif($jadwals->kosong == 1)
                                                <div class="kosong me-2"></div>
                                            @elseif($jadwals->sibuk == 0 && $jadwals->kosong == 0)
                                                {{ null }}
                                            @endif
                                        </div>
                                    </div>
                                    <h3 class="slider-pro-title mt-4">Jadwal Dokter</h3>
                                    <p class="slider-pro-subtitle">
                                        @if ($jadwals->hari_akhir == null)
                                            {{ $jadwals->hari_awal }}
                                        @else
                                            {{ $jadwals->hari_awal }} - {{ $jadwals->hari_akhir }}
                                        @endif
                                    </p>
                                    <p class="slider-pro-subtitle">
                                        {{ \Carbon\Carbon::parse($jadwals->jam_awal)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwals->jam_akhir)->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <p class="slider-pro-title mb-1">Keterangan</p>
                        <p class="slider-pro-subtitle">Jadwal terupdate setiap harinya</p>
                        <div class="mt-3 d-flex justify-content-start align-items-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="status">
                                    <div class="sibuk me-2"></div>
                                </div>
                                <p class="slider-pro-subtitle me-3">Sibuk/Penuh</p>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="status">
                                    <div class="kosong me-2"></div>
                                </div>
                                <p class="slider-pro-subtitle me-3">Tidak Sibuk/Kosong</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
