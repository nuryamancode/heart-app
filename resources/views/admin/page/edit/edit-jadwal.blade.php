@extends('admin.base.layout', ['title' => 'Edit Jadwal Dokter'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola Jadwal Dokter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-jadwal', $jadwal->id) }}" enctype="multipart/form-data">
                    @csrf
                    <label for="" class="form-label">Jadwal <span class="text-danger">*</span></label>
                    <div class="d-flex align-items-center mb-3">
                        <div class="form-check me-4">
                            <input class="form-check-input border-secondary" type="checkbox" value="1" id="sibuk"
                                name="sibuk" {{ $jadwal->sibuk == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="sibuk">
                                Sibuk
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border-secondary" type="checkbox" value="1" id="kosong"
                                name="kosong" {{ $jadwal->kosong == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="kosong">
                                Kosong
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_dokter" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                        <input type="text" class="form-control border-secondary" id="nama_dokter" name="nama_dokter"
                            value="{{ $jadwal->nama_dokter }}">
                        @error('nama_dokter')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="grid-layouts mb-3">
                        <div class="mb-3">
                            <label for="fotoArtikel" class="form-label">Foto</label>
                            <input type="file" class="form-control border-secondary" id="fotoArtikel" name="foto">
                            @error('foto')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div style="width: 150px; height: 100px">
                            <img src="{{ asset('/images/dokter/' . $jadwal->foto) }}" alt=""
                                style="width: 100%; height: 100%">
                        </div>
                    </div>
                    <div class="grid-layouts">
                        <div class="mb-3">
                            <label for="hari_awal" class="form-label">Hari Awal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control border-secondary" id="hari_awal" name="hari_awal"
                                value="{{$jadwal->hari_awal }}">
                            @error('hari_awal')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hari_akhir" class="form-label">Hari Akhir</label>
                            <input type="text" class="form-control border-secondary" id="hari_akhir" name="hari_akhir"
                                value="{{ $jadwal->hari_akhir }}">
                            @error('hari_akhir')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid-layouts">
                        <div class="mb-3">
                            <label for="jam_awal" class="form-label">Jam Awal <span class="text-danger">*</span></label>
                            <input type="time" class="form-control border-secondary" id="jam_awal" name="jam_awal"
                                value="{{ $jadwal->jam_awal }}">
                            @error('jam_awal')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jam_akhir" class="form-label">Jam Akhir <span class="text-danger">*</span></label>
                            <input type="time" class="form-control border-secondary" id="jam_akhir" name="jam_akhir"
                                value="{{ $jadwal->jam_akhir }}">
                            @error('jam_akhir')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
