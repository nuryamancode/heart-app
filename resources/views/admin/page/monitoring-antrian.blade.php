@extends('admin.base.layout', ['title' => 'Monitoring Antrian'])

@section('page-content')
    <div class="container">
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
@endsection
