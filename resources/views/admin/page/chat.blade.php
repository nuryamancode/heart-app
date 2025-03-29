@extends('admin.base.layout', ['title' => 'Konsultasi Chat'])

@section('page-content')
    <div class="row chat-wrapper">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row position-relative">
                        <!-- Sidebar Riwayat Chat -->
                        <div class="col-lg-4 chat-aside border-end-lg">
                            <div class="aside-content">
                                <div class="aside-header">
                                    <h6 class="mb-3">Riwayat Chat</h6>
                                </div>
                                <div class="aside-body">
                                    <ul class="list-unstyled chat-list">
                                        @foreach ($users as $user)
                                            <li class="chat-item">
                                                <a href="{{ route('chat-room', $user->id) }}" class="d-flex align-items-center">
                                                    <figure class="mb-0 me-2">
                                                        <img src="{{ $user->foto ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                                                            class="img-xs rounded-circle" alt="user">
                                                    </figure>
                                                    <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                        <div>
                                                            <p class="text-body fw-bolder">{{ $user->name }}</p>
                                                            <p class="text-secondary fs-13px">
                                                                {{ $user->send->first()->message ?? 'Belum ada pesan.' }}
                                                            </p>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-end">
                                                            <p class="text-secondary fs-13px mb-1">
                                                                {{ $user->send->first() ? $user->send->first()->created_at->format('h:i A') : '' }}
                                                            </p>
                                                            <div class="badge rounded-pill bg-primary">
                                                                1
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        
    </script>    
@endsection
