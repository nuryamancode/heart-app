@extends('admin.base.layout', ['title' => 'Tambah No Antrian'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola No Antrian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('post-no-antrian') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="jumlahAntrian" class="form-label">Jumlah Antrian</label>
                        <input type="number" class="form-control border-secondary" id="jumlahAntrian" min="1"
                            max="500" name="jumlah" value="{{ old('jumlah') }}">
                        @error('jumlah')
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
