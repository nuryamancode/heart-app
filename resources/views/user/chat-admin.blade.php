@extends('user.components.base', ['title' => 'Live Chat'])
@section('content')
    <header class="top-navbar">
        <div class="container">
            <div class="top-navbar_full">
                <div class="back-btn d-flex align-items-center">
                    <a href="javascript: history.go(-1)">
                        <img src="{{ asset('assets/images/forget-password-screen/back-btn.svg') }}" alt="back-btn-img">
                    </a>
                </div>
                <div class="top-navbar-title d-flex align-items-center">
                    <p>Live Chat</p>
                </div>
            </div>
        </div>
        <div class="navbar-boder"></div>
    </header>

    <section class="chat-section">
        <div class="chat-container">
            <!-- Chat Box -->
            <div id="chat-box" class="chat-box">
                <!-- Pesan akan dimuat dan dirender di sini -->
            </div>

            <!-- Input Form -->
            <form id="chat-input-form" class="chat-input-form">
                @csrf
                <div class="input-group">
                    <input type="text" id="message" name="message" class="form-control border-secondary"
                        placeholder="Tulis pesan..." required>
                    <button type="submit" class="btn btn-primary">
                        <img src="{{ asset('assets/image-new/send.png') }}" alt="Send" style="width: 24px"
                            height="24px">
                    </button>
                </div>
            </form>
        </div>
    </section>


    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Initialize Pusher
        const pusher = new Pusher('4ca13cd3a9737e07eec8', {
            cluster: 'ap1',
        });

        pusher.connection.bind('connected', function() {
            console.log('Pusher connected successfully');
        });

        pusher.connection.bind('error', function(err) {
            console.error('Pusher connection error:', err);
        });
        // Subscribe to the channel
        const channel = pusher.subscribe('user-chat');

        // Listen for the SendUserMessage event
        channel.bind('SendUserMessage', function(data) {
            console.log('Received message:');
            renderMessage(data.message, data.sender_id === {{ Auth::id() }} ? 'user-message' : 'admin-message');
        });

        function renderMessage(message, type) {
            const chatBox = document.getElementById('chat-box');

            // Create a message element
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message ${type}`;
            messageDiv.innerHTML = `
                <p>${message}</p>
                <small class="message-time">${getCurrentTime()}</small>
            `;

            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
        }

        function getCurrentTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            return `${hours % 12 || 12}:${minutes.toString().padStart(2, '0')} ${hours >= 12 ? 'PM' : 'AM'}`;
        }

        function fetchMessages() {
            fetch('{{ route('fetch.to-admin') }}?receiver_id=1') // Sesuaikan receiver_id (Admin)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = ''; // Bersihkan kotak pesan

                    data.messages.forEach(message => {
                        const type = message.sender_id === {{ Auth::id() }} ? 'user-message' :
                            'admin-message';
                        renderMessageWithTimestamp(message.message, type, message.created_at);
                    });

                    chatBox.scrollTop = chatBox.scrollHeight; // Scroll ke bawah otomatis
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        // Panggil fetchMessages saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchMessages);

        function renderMessageWithTimestamp(message, type, timestamp) {
            const chatBox = document.getElementById('chat-box');
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message ${type}`;
            messageDiv.innerHTML = `
                <p>${message}</p>
                <small class="message-time">${formatTimestamp(timestamp)}</small>
            `;
            chatBox.appendChild(messageDiv);
        }

        // Fungsi untuk memformat timestamp menjadi HH:MM AM/PM
        function formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const hours = date.getHours();
            const minutes = date.getMinutes();
            const formattedTime = `${hours % 12 || 12}:${minutes.toString().padStart(2, '0')} ${
                hours >= 12 ? 'PM' : 'AM'
            }`;
            return formattedTime;
        }

        // AJAX untuk kirim pesan
        document.getElementById('chat-input-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            // Get the message from the input field
            const message = document.getElementById('message').value;

            // Send the message using AJAX
            fetch('/user/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is sent
                    },
                    body: JSON.stringify({
                        message: message,
                        receiver_id: 1 // Replace with the actual Admin ID
                    })
                })
                .then(response => {
                    console.log('Response:', response);
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Message sent successfully', data);
                        renderMessage(message, 'user-message');
                        document.getElementById('message').value = ''; // Clear the input field
                    } else {
                        console.log('Message sent successfully');
                        alert('Failed to send message: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error sending message');
                });

        });
    </script>


@endsection
