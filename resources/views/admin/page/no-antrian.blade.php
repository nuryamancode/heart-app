@extends('admin.base.layout', ['title' => 'Kelola No Antrian'])

@push('css')
    <style>
        .antrian{
            background-color: #54c42e;
            border-radius: 10px;
        }
        .card-title{
            text-align: center !important;
            margin-bottom: 30px !important;
        }
        .btn-secondary{
            background-color: #fff !important;
            color: #000 !important;
            border: none !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            border-radius: 10px !important;
        }
    </style>
@endpush

@section('page-content')
    <div class="row chat-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-start">
                            <a href="{{ route('add-no-antrian') }}" class="btn btn-primary">Tambah Data</a>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center g-1">
                            <div class="col-4">
                                <div class="card antrian">
                                    <div class="card-body">
                                        <h4 class="card-title">Antrian A001</h4>
                                        <div class="btn btn-secondary disabled">
                                            Status Antrian
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card antrian">
                                    <div class="card-body">
                                        <h4 class="card-title">Antrian A001</h4>
                                        <div class="btn btn-secondary disabled">
                                            Status Antrian
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card antrian">
                                    <div class="card-body">
                                        <h4 class="card-title">Antrian A001</h4>
                                        <div class="btn btn-secondary disabled">
                                            Status Antrian
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card antrian">
                                    <div class="card-body">
                                        <h4 class="card-title">Antrian A001</h4>
                                        <div class="btn btn-secondary disabled">
                                            Status Antrian
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="dataTableExample" class="table table-striped table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor Antrian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrian as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->no_antrian }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit-no-antrian', $item->id) }}"
                                                class="btn btn-primary me-3"><i class="link-icon"
                                                    data-feather="edit"></i></a>
                                            <a data-bs-toggle="modal" data-bs-target="#hapusButton{{ $item->id }}"
                                                class="btn btn-danger"><i class="link-icon" data-feather="trash-2"></i></a>
                                        </td>
                                    </tr>
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
                                                    <form action="{{ route('delete-no-antrian', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
