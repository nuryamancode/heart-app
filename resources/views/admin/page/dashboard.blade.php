@extends('admin.base.layout', ['title' => 'Dashboard'])

@section('page-content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Artikel</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="icon-lg text-secondary pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('artikel') }}"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $artikelCount }}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Jadwal Dokter</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-secondary pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('jadwal-dokter') }}"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $jadwalCount }}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">No Antrian</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-secondary pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('no-antrian') }}"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $noAntrianCount }}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="card">
            <div class="card-body">
                <div class="row position-relative">
                    <div class="col-lg-4 chat-aside border-end-lg">
                        <div class="aside-content">
                            <div class="aside-header">
                                <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>Riwayat Chat</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="aside-body">
                                <div class="tab-content mt-3">
                                    <div class="tab-pane fade show active" id="chats" role="tabpanel"
                                        aria-labelledby="chats-tab">
                                        <div>
                                            <ul class="list-unstyled chat-list px-1">
                                                <li class="chat-item pe-1">
                                                    <a href="javascript:;" class="d-flex align-items-center">
                                                        <figure class="mb-0 me-2">
                                                            <img src="https://via.placeholder.com/37x37"
                                                                class="img-xs rounded-circle" alt="user">
                                                            <div class="status online"></div>
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-body fw-bolder">John Doe</p>
                                                                <p class="text-secondary fs-13px">Hi, How are you?</p>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-secondary fs-13px mb-1">4:32 PM</p>
                                                                <div class="badge rounded-pill bg-primary ms-auto">5
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="chat-item pe-1">
                                                    <a href="javascript:;" class="d-flex align-items-center">
                                                        <figure class="mb-0 me-2">
                                                            <img src="https://via.placeholder.com/37x37"
                                                                class="img-xs rounded-circle" alt="user">
                                                            <div class="status offline"></div>
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-body">John Doe</p>
                                                                <p class="text-secondary fs-13px">Hi, How are you?</p>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-secondary fs-13px mb-1">Yesterday</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="antrian-sec">
                            @foreach ($antrian as $antrians)
                                <div class="antrian-sec-slide-full">
                                    <div class="antrian-img-sec text-center">
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
            </div>
        </div>
    </div>
@endsection
