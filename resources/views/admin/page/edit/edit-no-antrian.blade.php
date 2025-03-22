@extends('admin.base.layout', ['title' => 'Edit No Antrian'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola No Antrian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-no-antrian', $antrian->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="noAntrian" class="form-label">No Antrian</label>
                        <input type="number" class="form-control border-secondary" id="noAntrian" min="1"
                            max="100" name="no_antrian" value="{{ $antrian->no_antrian }}">
                        @error('no_antrian')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div style="width: 200px; height: 200px">
                        <img src="{{ asset('/images/number/' . $antrian->foto) }}" alt=""
                            style="width: 100%; height: 100%">
                    </div>
                    <div class="mb-3">
                        <label for="fotoAntrian" class="form-label">Foto</label>
                        <input type="file" class="form-control border-secondary" id="fotoAntrian" name="foto">
                        @error('foto')
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
