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
                                    <h6>Riwayat Chat</h6>
                                </div>
                                <div class="aside-body">
                                    <ul class="list-unstyled chat-list">
                                        @foreach ($users as $user)
                                            <li class="chat-item"
                                                onclick="selectUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->foto ?? 'https://via.placeholder.com/37x37' }}')">
                                                <a href="javascript:;" class="d-flex align-items-center">
                                                    <figure class="mb-0 me-2">
                                                        <img src="{{ $user->foto ?? 'https://via.placeholder.com/37x37' }}"
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
                                                            @php
                                                                $unreadCount = $user->send
                                                                    ->where('seen', false)
                                                                    ->count();
                                                            @endphp
                                                            @if ($unreadCount > 0)
                                                                <div class="badge rounded-pill bg-primary">
                                                                    {{ $unreadCount }}
                                                                </div>
                                                            @endif
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
                                        <img class="img-sm rounded-circle" id="chat_img">
                                    </figure>
                                    <p id="chat_name"></p>
                                </div>
                            </div>
                            <div class="chat-body">
                                <ul class="messages" id="chat-box">
                                    <!-- Pesan akan dirender di sini -->
                                </ul>
                            </div>
                            <div class="chat-footer d-flex">
                                <form class="search-form flex-grow-1 me-2" id="chat-form">
                                    @csrf
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

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        let receiverId = null;
        let receiverName = '';
        let receiverImage = '';


        // Handle user selection
        function selectUser(id, name, image) {
            receiverId = id;
            receiverName = name;
            receiverImage = image;

            document.getElementById('chat_name').innerText = receiverName;
            document.getElementById('chat_img').src = receiverImage;

            // Hapus badge unread ketika user dipilih
            const unreadBadge = document.querySelector(`#user-${id} .badge`);
            if (unreadBadge) {
                unreadBadge.remove(); // Hapus badge unread
            }

            // Mark the messages as read
            markMessagesAsSeen(receiverId);

            // Fetch messages for the selected user
            fetchMessages();
        }

        const pusher = new Pusher('4ca13cd3a9737e07eec8', {
            cluster: 'ap1',
        });
        const channel = pusher.subscribe('admin-chat');
        channel.bind('SendAdminMessage', function(data) {
            console.log('Pesan dari Pusher:', data);
            const messageType = data.sender_id === {{ Auth::id() }} ? 'me' : 'friend';
            if (data.receiver_id === receiverId) {
                renderMessage(data.message, messageType);

                // Scroll otomatis ke bawah
                const chatBox = document.getElementById('chat-box');
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });

        function renderMessage(message, type) {
            const chatBox = document.getElementById('chat-box');
            const messageItem = document.createElement('li');
            messageItem.className = `message-item ${type}`;
            messageItem.innerHTML = `
                <div class="content">
                    <div class="message">
                        <div class="bubble">
                            <p>${message}</p>
                        </div>
                        <span>${getCurrentTime()}</span>
                    </div>
                </div>
            `;
            chatBox.appendChild(messageItem);

            // Scroll otomatis ke bawah setelah pesan ditambahkan
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function getCurrentTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            return `${hours % 12 || 12}:${minutes.toString().padStart(2, '0')} ${hours >= 12 ? 'PM' : 'AM'}`;
        }

        function fetchMessages() {
            if (receiverId) {
                fetch('{{ route('fetch.to-user') }}?receiver_id=' + receiverId)
                    .then(response => response.json())
                    .then(data => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.innerHTML = ''; // Kosongkan daftar pesan

                        if (data.messages && data.messages.length > 0) {
                            data.messages.forEach(message => {
                                const messageType = message.sender_id === {{ Auth::id() }} ? 'me' :
                                'friend';
                                renderMessageWithTimestamp(message.message, messageType, message.created_at);
                            });

                            // Scroll otomatis ke bawah setelah semua pesan dirender
                            chatBox.scrollTop = chatBox.scrollHeight;
                        } else {
                            const noMessagesItem = document.createElement('li');
                            noMessagesItem.innerText = 'Tidak ada pesan.';
                            chatBox.appendChild(noMessagesItem);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching messages:', error);
                        alert('Error fetching messages');
                    });
            }
        }


        document.addEventListener('DOMContentLoaded', fetchMessages);

        function renderMessageWithTimestamp(message, type, timestamp) {
            const chatBox = document.getElementById('chat-box');
            const messageItem = document.createElement('li');
            messageItem.className = `message-item ${type}`;
            messageItem.innerHTML = `
                <div class="content">
                    <div class="message">
                        <div class="bubble">
                            <p>${message}</p>
                        </div>
                        <span>${formatTimestamp(timestamp)}</span>
                    </div>
                </div>
            `;
            chatBox.appendChild(messageItem);

            // Scroll to the bottom after a new message is added
            chatBox.scrollTop = chatBox.scrollHeight;
        }


        // Function to format timestamp to HH:MM AM/PM
        function formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const hours = date.getHours();
            const minutes = date.getMinutes();
            const formattedTime = `${hours % 12 || 12}:${minutes.toString().padStart(2, '0')} ${hours >= 12 ? 'PM' : 'AM'}`;
            return formattedTime;
        }

        // AJAX for sending messages
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            if (!receiverId) {
                alert('Please select a user to chat with.');
                return;
            }

            const message = document.getElementById('message').value;

            // Kirim pesan menggunakan AJAX
            fetch("{{ route('send.to-user') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan CSRF token dikirim
                    },
                    body: JSON.stringify({
                        message: message,
                        receiver_id: receiverId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Message sent successfully', data);

                        // Tambahkan pesan langsung ke UI dengan kelas "me"
                        renderMessage(message, 'me');

                        // Kosongkan input field setelah pesan dikirim
                        document.getElementById('message').value = '';

                        // Scroll otomatis ke bawah
                        const chatBox = document.getElementById('chat-box');
                        chatBox.scrollTop = chatBox.scrollHeight;
                    } else {
                        alert('Failed to send message: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error sending message');
                });
        });

        // Memanggil API untuk menandai pesan sebagai sudah terbaca
        function markMessagesAsSeen(receiverId) {
            // Menghasilkan URL menggunakan route() Laravel
            const url = "{{ route('mark.seen', ':receiverId') }}".replace(':receiverId', receiverId);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Kirimkan token CSRF
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Gagal memperbarui status pesan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status pesan.');
                });
        }
    </script>
@endsection
