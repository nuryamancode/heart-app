@extends('admin.base.layout', ['title' => 'Konsultasi Chat'])

@push('css')
    <style>
        /* Style dasar untuk chat body */
        .chat-body {
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
        }

        /* Styling untuk daftar pesan */
        .messages {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* Styling untuk pesan dari admin */
        .content.user .message {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .content.user .bubble {
            background-color: #f1f1f1;
            color: #333;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 60%;
            font-size: 14px;
        }

        .content.user .times {
            font-size: 12px;
            color: #888;
            text-align: end;
        }

        /* Styling untuk pesan dari pengguna */
        .content.me .message {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .content.me .bubble {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 60%;
            font-size: 14px;
        }

        .content.me .times {
            font-size: 12px;
            color: #fff;
            text-align: end;
        }

        #chat-box {
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #chat-box::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush

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
                                                <a href="{{ route('chat-room', $user->id) }}"
                                                    class="d-flex align-items-center">
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

                        <!-- Konten Chat -->
                        <div class="col-lg-8 chat-content">
                            <div class="chat-header border-bottom pb-2">
                                <div class="d-flex align-items-center">
                                    <figure class="mb-0 me-2">
                                        <img src="{{ $user->foto ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                                            class="img-xs rounded-circle" alt="user">
                                    </figure>
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="chat-body">
                                <ul class="messages" id="chat-box">
                                    @foreach ($chat as $item)
                                        {{-- @php
                                        dd($user->id == $item->sender_id);
                                    @endphp --}}
                                        <li class="content {{ $user->id == $item->sender_id ? 'user' : 'me' }}">
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>{{ $item->message }}</p>
                                                    <span class="times">{{ $item->created_at->format('h:i A') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Input Form untuk Mengirim Pesan -->
                            <div class="chat-footer d-flex">
                                <form class="search-form flex-grow-1 me-2" id="chatForm">
                                    @csrf
                                    <input type="hidden" value="{{ $user->id }}" name="receiver_id" id="receiver_id">
                                    <div class="input-group">
                                        <input type="text" class="form-control rounded-pill" id="message"
                                            placeholder="Type a message">
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-icon rounded-circle"
                                                id="sendMessage">
                                                <i data-feather="send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('message');
            const receiverId = document.getElementById('receiver_id').value;
            const chatBox = document.getElementById('chat-box');

            function formatTime(dateString) {
                if (!dateString) return 'Invalid Time';
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return 'Invalid Time';

                let hours = date.getHours();
                let minutes = date.getMinutes();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12 || 12;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                return `${hours}:${minutes} ${ampm}`;
            }

            chatForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const message = messageInput.value.trim();
                if (message === '') return;

                fetch('/admin/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: message,
                            receiver_id: receiverId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.message) {
                            console.error('Data tidak valid:', data);
                            return;
                        }

                        // Setelah pesan berhasil dikirim, tambahkan ke chat box
                        appendMessage({
                            message: data.message,
                            created_at: new Date().toISOString(),
                            sender_id: {{ auth()->id() }}
                        }, 'me');

                        messageInput.value = ''; // Bersihkan input setelah kirim
                        chatBox.scrollTop = chatBox.scrollHeight; // Scroll ke bawah otomatis
                    })
                    .catch(error => console.error('Error sending message:', error));
            });

            function appendMessage(message, senderClass) {
                const newMessageElement = document.createElement('li');
                newMessageElement.classList.add('content', senderClass);
                newMessageElement.innerHTML = `
            <div class="message">
                <div class="bubble">
                    <p>${message.message}</p>
                    <span class="times">${formatTime(message.created_at)}</span>
                </div>
            </div>
        `;
                chatBox.appendChild(newMessageElement);
            }

            function fetchMessages() {
                fetch(`/admin/fetch-admin?receiver_id=${receiverId}`)
                    .then(response => response.json())
                    .then(data => {
                        chatBox.innerHTML = '';
                        data.messages.forEach(msg => {
                            appendMessage(msg, msg.sender_id == receiverId ? 'user' : 'me');
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            }

            // Polling every 3 seconds (3000 milliseconds)
            setInterval(fetchMessages, 1000);

            fetchMessages(); // Initial fetch when page loads
        });
    </script>
@endsection
