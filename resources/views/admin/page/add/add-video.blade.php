@extends('admin.base.layout', ['title' => 'Tambah Video Tutorial'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola Tutorial Video</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('post-video') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="video" class="form-label">Video</label>
                        <input type="file" class="form-control border-secondary" id="video" name="video">
                        @error('video')
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
