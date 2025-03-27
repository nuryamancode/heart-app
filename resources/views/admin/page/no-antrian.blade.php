@extends('admin.base.layout', ['title' => 'Kelola Antrian'])

@push('css')
    <style>
        .belum-diambil {
            background-color: #0fc58e;
            border-radius: 10px !important;
            color: #000 !important;
        }

        .dipanggil {
            background-color: #0f6dc5;
            border-radius: 10px !important;
            color: #fff !important;
        }

        .waiting {
            background-color: #e0d20b;
            border-radius: 10px !important;
            color: #000 !important;
        }

        .dilewati {
            background-color: #d12b15;
            border-radius: 10px !important;
            color: #ccc !important;
        }

        .selesai {
            background-color: #54c42e;
            border-radius: 10px !important;
            color: #000 !important;
        }

        .card-title {
            text-align: center !important;
            margin-bottom: 30px !important;
        }

        .btn-secondary {
            background-color: #fff !important;
            color: #000 !important;
            border: none !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            border-radius: 10px !important;
        }

        .bg-secondary {
            border-radius: 0 0 10px 10px !important;
            background-color: #ccc !important;
        }
    </style>
@endpush

@section('page-content')
    <div class="row chat-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="text-start mb-3">
                        <a href="{{ route('add-no-antrian') }}" class="btn btn-primary">Tambah Antrian</a>

                        <form action="{{ route('delete-no-antrian-all') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="date" value="{{ request('date') }}">
                            <button type="submit" class="btn btn-danger">Hapus Semua Antrian</button>
                        </form>

                        <form action="{{ route('no-antrian') }}" method="GET">
                            <div class="input-group mt-3">
                                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        <div class="flter d-flex justify-content-start align-items-center mt-3">
                            <!-- Belum diambil Button -->
                            <a href="{{ route('no-antrian') }}?status=0&date={{ request('date') }}"
                                class="btn btn-success belum-diambil border-0 me-2">Belum diambil
                            </a>
                            <!-- Menunggu Dipanggil Button -->
                            <a href="{{ route('no-antrian') }}?status=1&date={{ request('date') }}"
                                class="btn btn-warning waiting border-0 me-2">Menunggu dipanggil
                            </a>
                            <!-- Dipanggil Button -->
                            <a href="{{ route('no-antrian') }}?status=2&date={{ request('date') }}"
                                class="btn btn-primary dipanggil border-0 me-2">Dipanggil
                            </a>
                            <!-- Selesai Button -->
                            <a href="{{ route('no-antrian') }}?status=3&date={{ request('date') }}"
                                class="btn btn-success selesai border-0 me-2">Selesai
                            </a>
                            <!-- Dilewati Button -->
                            <a href="{{ route('no-antrian') }}?status=4&date={{ request('date') }}"
                                class="btn btn-danger dilewati border-0 me-2">Dilewati
                            </a>
                        </div>

                    </div>
                    @if (count($antrian) > 0)
                        <div class="row d-flex justify-content-start align-items-center g-2 overflow-x-hidden-hidden">
                            @foreach ($antrian as $item)
                                @php
                                    $status = [
                                        0 => 'Belum diambil',
                                        1 => 'Menunggu dipanggil',
                                        2 => 'Dipanggil',
                                        3 => 'Selesai',
                                        4 => 'Dilewati',
                                    ];
                                    $color = [
                                        0 => 'belum-diambil',
                                        1 => 'waiting',
                                        2 => 'dipanggil',
                                        3 => 'selesai',
                                        4 => 'dilewati',
                                    ];
                                @endphp

                                <div class="col-4">
                                    <div class="card {{ $color[$item->status] }}" style="min-height: 255px !important">
                                        <div class="card-body">
                                            <h4 class="card-title">Antrian <span
                                                    style="font-weight: 600">{{ $item->no_antrian }}</span>
                                            </h4>
                                            <div class="btn btn-secondary disabled">
                                                {{ $status[$item->status] }}
                                            </div>
                                            <div class="text-center mt-2">
                                                @if ($item->user_id != null)
                                                    <p>Oleh</p>
                                                    <h4>{{ $item->user->name }}</h4>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="card-footer d-flex justify-content-center align-items-center bg-secondary">
                                            <a data-bs-toggle="modal" data-bs-target="#hapusButton{{ $item->id }}"
                                                class="btn btn-danger me-auto" title="Hapus">
                                                <i class="link-icon" data-feather="trash-2"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                            <a href=""
                                                class="btn btn-success me-auto {{ $item->status == 0 || $item->status == 1 || $item->status == 3 || $item->status == 4 ? 'disabled' : '' }}"
                                                title="Selesai">
                                                <i class="link-icon" data-feather="user-check"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>


                                            <a href=""
                                                class="btn btn-primary me-auto {{ $item->status == 0 || $item->status == 2 || $item->status == 3 || $item->status == 4 ? 'disabled' : '' }}"
                                                title="Panggil">
                                                <i class="link-icon" data-feather="phone"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                            <a href=""
                                                class="btn btn-warning me-auto {{ $item->status == 0 || $item->status == 1 || $item->status == 3 || $item->status == 4 ? 'disabled' : '' }}"
                                                title="Lewati">
                                                <i class="link-icon" data-feather="skip-forward"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="hapusButton{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Kamu Yakin Ingin Menghapus?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <form action="{{ route('delete-no-antrian', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row d-flex justify-content-center align-items-center g-1">
                            <div class="col-4">
                                <div class="card antrian">
                                    <div class="card-body">
                                        <h4 class="card-title">Belum Ada Antrian</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
