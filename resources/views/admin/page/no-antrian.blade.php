@extends('admin.base.layout', ['title' => 'Kelola No Antrian'])

@push('css')
    <style>
        .antrian {
            background-color: #54c42e;
            border-radius: 10px !important;
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
                    </div>
                    @if (count($antrian) > 0)
                        <div class="row d-flex justify-content-start align-items-center g-1 overflow-x-hidden-hidden">
                            @foreach ($antrian as $item)
                                <div class="col-4">
                                    <div class="card antrian">
                                        <div class="card-body">
                                            <h4 class="card-title">Antrian {{ $item->no_antrian }}</h4>
                                            <div class="btn btn-secondary disabled">
                                                Status Antrian
                                            </div>
                                        </div>
                                        <div
                                            class="card-footer d-flex justify-content-center align-items-center bg-secondary">
                                            <a href="" class="btn btn-danger me-auto" title="Hapus">
                                                <i class="link-icon" data-feather="trash"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                            <a href="" class="btn btn-success me-auto" title="Selesai">
                                                <i class="link-icon" data-feather="user-check"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                            <a href="" class="btn btn-primary me-auto" title="Panggil">
                                                <i class="link-icon" data-feather="phone"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
                                            <a href="" class="btn btn-warning me-auto" title="Lewati">
                                                <i class="link-icon" data-feather="skip-forward"
                                                    style="width: 16px; height: 16px;"></i>
                                            </a>
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
