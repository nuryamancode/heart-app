@extends('admin.base.layout', ['title' => 'Edit Artikel'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola Artikel</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-artikel', $artikel->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="number" class="form-control border-secondary" id="judul" min="1"
                            max="100" name="judul" value="{{ $artikel->judul }}">
                        @error('judul')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div style="width: 200px; height: 200px">
                        <img src="{{ asset('/images/number/' . $artikel->foto) }}" alt=""
                            style="width: 100%; height: 100%">
                    </div>
                    <div class="mb-3">
                        <label for="fotoArtikel" class="form-label">Foto</label>
                        <input type="file" class="form-control border-secondary" id="fotoArtikel" name="foto">
                        @error('foto')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Deskripsi</label>
                        <textarea name="isi" id="isi" class="form-control border-secondary">{{ $artikel->isi }}</textarea>
                        @error('isi')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
