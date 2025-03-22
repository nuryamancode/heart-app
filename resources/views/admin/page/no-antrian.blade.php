@extends('admin.base.layout', ['title' => 'Kelola No Antrian'])

@section('page-content')
    <div class="row chat-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="text-end">
                            <a href="{{ route('add-no-antrian') }}" class="btn btn-secondary">Tambah Data</a>
                        </div>
                        <table id="dataTableExample" class="table table-striped table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor Antrian</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrian as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->no_antrian }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('images/number/' . $item->foto) }}" alt="Foto"
                                                style="width: 50px; height: 50px;">
                                        </td>
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
                                                        <form action="{{ route('delete-no-antrian', $item->id) }}" method="POST">
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
