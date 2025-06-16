@extends('utama.app')

@section('content')
<div class="container-fluid p-3">
    <div class="row justify-content-center mx-0">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 px-0">
            <div class="chat-app shadow-lg rounded-3 d-flex flex-column" style="height: calc(100vh - 120px);">
                
                <!-- Header -->
                <div class="chat-header text-white p-3 d-flex align-items-center rounded-top" style="background-color: #2980b9;">
                    <div class="avatar me-3" style="background-color: rgba(255,255,255,0.2);">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Brightmart Support</h6>
                        <small class="opacity-75">Online</small>
                    </div>
                    <div>
                        <button class="btn btn-sm text-white" style="background-color: rgba(255,255,255,0.2);">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Chat Area -->
                <div id="chat-messages" class="flex-grow-1 p-3" style="overflow-y: auto; background-color: #f5f5f5;">
                    <div class="text-center text-muted py-5" id="empty-state">
                        <i class="far fa-comment-dots fa-2x mb-3"></i>
                        <p>Belum ada percakapan</p>
                        <small>Mulai chat dengan customer service kami</small>
                    </div>
                    <!-- Messages will appear here -->
                </div>
                
                <!-- Input Area (Fixed at bottom) -->
                <div class="chat-input bg-white p-3 border-top rounded-bottom" style="margin-top: auto;">
                    <form id="message-form" class="d-flex align-items-center">
                        @csrf
                        <button type="button" class="btn btn-link text-muted me-2">
                            <i class="far fa-smile"></i>
                        </button>
                        <button type="button" class="btn btn-link text-muted me-2">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <input type="text" id="message-input" class="form-control rounded-pill" 
                               placeholder="Ketik pesan..." style="flex-grow: 1;">
                        <button type="submit" class="btn ms-2 rounded-circle" style="width: 40px; height: 40px; background-color: #2980b9; color: white;">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Base Styles */
    body {
        background-color: #f0f2f5;
    }
    
    .chat-app {
        border: 1px solid rgba(0,0,0,0.1);
        background-color: white;
        display: flex;
        flex-direction: column;
    }
    
    /* Header */
    .chat-header {
        height: 64px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    /* Avatar */
    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Message Bubbles */
    .message {
        max-width: 75%;
        margin-bottom: 12px;
        position: relative;
    }
    
    .message-user {
        margin-left: auto;
    }
    
    .message-bot {
        margin-right: auto;
    }
    
    .message-content {
        padding: 8px 12px;
        border-radius: 8px;
        position: relative;
        word-wrap: break-word;
        box-shadow: 0 1px 0.5px rgba(0,0,0,0.1);
    }
    
    .user-bubble {
        background-color: #2980b9;
        color: white;
        border-top-right-radius: 0 !important;
    }
    
    .bot-bubble {
        background-color: #f1f1f1;
        border-top-left-radius: 0 !important;
    }
    
    .message-time {
        font-size: 0.7rem;
        color: #667781;
        margin-top: 4px;
        text-align: right;
    }
    
    /* Input Area */
    .chat-input {
        min-height: 70px;
        border-top: 1px solid rgba(0,0,0,0.1);
    }
    
    #message-input {
        border: 1px solid #ddd;
        padding: 8px 15px;
    }
    
    #message-input:focus {
        box-shadow: none;
        border-color: #2980b9;
    }
    
    /* Scrollbar */
    #chat-messages::-webkit-scrollbar {
        width: 6px;
    }
    
    #chat-messages::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.05);
    }
    
    #chat-messages::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.2);
        border-radius: 3px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 10px;
        }
        
        .chat-app {
            height: calc(100vh - 80px) !important;
        }
        
        .message {
            max-width: 85%;
        }
    }
    
    @media (min-width: 1200px) {
        .col-xl-6 {
            max-width: 800px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        // Load initial messages
        loadMessages();
        
        // Form submission
        $('#message-form').on('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });
        
        // Send on Enter key
        $('#message-input').keypress(function(e) {
            if (e.which === 13 && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
        
        function loadMessages() {
            $.get("{{ route('get.messages') }}", function(data) {
                $('#chat-messages').empty();
                
                if (data.length === 0) {
                    $('#chat-messages').html(`
                        <div class="text-center text-muted py-5" id="empty-state">
                            <i class="far fa-comment-dots fa-2x mb-3"></i>
                            <p>Belum ada percakapan</p>
                            <small>Mulai chat dengan customer service kami</small>
                        </div>
                    `);
                } else {
                    data.forEach(function(message) {
                        appendMessage(message);
                    });
                    scrollToBottom();
                }
            }).fail(function() {
                $('#chat-messages').html(`
                    <div class="alert alert-danger m-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Gagal memuat percakapan. Silakan refresh halaman.
                    </div>
                `);
            });
        }
        
        function sendMessage() {
            const input = $('#message-input');
            const message = input.val().trim();
            
            if (message !== '') {
                // Create temporary message
                const tempId = 'temp-' + Date.now();
                const tempMessage = {
                    id: tempId,
                    user_id: {{ Auth::id() }},
                    message: message,
                    sender: 'user',
                    created_at: new Date().toISOString()
                };
                
                appendMessage(tempMessage);
                scrollToBottom();
                input.val('');
                
                // Send to server
                $.ajax({
                    url: "{{ route('send.message') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        message: message
                    },
                    success: function(response) {
                        // Remove temporary message
                        $(`#message-${tempId}`).remove();
                        
                        // Add actual messages from server
                        appendMessage(response.user_message);
                        appendMessage(response.bot_message);
                        scrollToBottom();
                    },
                    error: function(xhr) {
                        // Mark message as failed
                        $(`#message-${tempId} .message-content`).append(
                            '<div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> Gagal mengirim</div>'
                        );
                        console.error(xhr.responseText);
                    }
                });
            }
        }
        
        function appendMessage(message) {
            const isUser = message.sender === 'user';
            const time = new Date(message.created_at).toLocaleTimeString([], { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            const messageHtml = `
                <div id="message-${message.id}" class="message ${isUser ? 'message-user' : 'message-bot'}">
                    <div class="message-content ${isUser ? 'user-bubble' : 'bot-bubble'}">
                        ${message.message}
                        <div class="message-time" style="color: ${isUser ? 'rgba(255,255,255,0.7)' : '#667781'}">${time}</div>
                    </div>
                </div>
            `;
            
            $('#chat-messages').append(messageHtml);
            $('#empty-state').remove();
        }
        
        function scrollToBottom() {
            const container = $('#chat-messages');
            container.scrollTop(container[0].scrollHeight);
        }
    });
</script>
@endsection