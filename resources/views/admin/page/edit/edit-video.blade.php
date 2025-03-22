@extends('admin.base.layout', ['title' => 'Edit Video Tutorial'])

@section('page-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: history.go(-1)">Kelola Tutorial Video</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-video', $video->id) }}" enctype="multipart/form-data">
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
                    <div style="width: 400px; height: 300px; overflow: hidden; position: relative;" class="mb-4">
                        <video controls loop style="width: 100%; height: 100%; object-fit: cover;">
                            <source src="{{ asset('video/' . $video->video) }}" type="video/mp4">
                        </video>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
