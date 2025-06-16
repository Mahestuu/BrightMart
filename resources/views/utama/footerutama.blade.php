<!-- Bubble Chat Customer Service -->
<div id="chat-bubble" onclick="toggleChat()">
    <i class="fas fa-comment-alt"></i> <!-- Menggunakan ikon chat dari Font Awesome -->
</div>

<div id="chat-box" class="hidden">

</div>

<footer id="footer">
    <div class="container">
        <div class="footer-left">
            <p>&copy; 2024 BrightMart. All rights reserved.</p>
            <p>Jalan Ir.Soekarno, Surabaya, Indonesia</p>
        </div>
        <div class="footer-right">
            <h4>Follow Social Media Kami</h4>
            <div class="social-media">
                <a href="https://facebook.com" target="_blank"><img src="{{ asset('icon/facebook-icon.svg') }}"
                        alt="" class="social-icon"></a>
                <a href="https://twitter.com" target="_blank"><img src="{{ asset('icon/twitter-icon.svg') }}"
                        alt="" class="social-icon"></a>
                <a href="https://instagram.com" target="_blank"><img src="{{ asset('icon/youtube-icon.svg') }}"
                        alt="" class="social-icon"></a>
                <a href="https://tiktok.com" target="_blank"><img src="{{ asset('icon/tiktok-icon.svg') }}"
                        alt="" class="social-icon"></a>
                <a href="https://tiktok.com" target="_blank"><img src="{{ asset('icon/tiktok-icon.svg') }}"
                        alt="" class="social-icon"></a>
                <a href="https://tiktok.com" target="_blank"><img src="{{ asset('icon/tiktok-icon.svg') }}"
                        alt="" class="social-icon"></a>

            </div>
        </div>
    </div>

</footer>
<script>
    function toggleChat() {
        const chatBox = document.getElementById("chat-box");
        const chatBubble = document.getElementById("chat-bubble");

        // Toggle class 'hidden' dan 'show' pada chatBox untuk memulai animasi pop-up
        if (chatBox.classList.contains("hidden")) {
            chatBox.classList.remove("hidden");
            setTimeout(() => {
                chatBox.classList.add("show"); // Memulai animasi muncul
            }, 10); // Sedikit penundaan agar animasi bisa terjadi
            chatBubble.classList.add("hidden"); // Sembunyikan bubble ketika chat box muncul
        } else {
            chatBox.classList.remove("show");
            setTimeout(() => {
                chatBox.classList.add("hidden"); // Setelah animasi selesai, sembunyikan chat box
            }, 300); // Menunggu 300ms (durasi animasi)
            chatBubble.classList.remove("hidden"); // Kembalikan bubble jika chat box disembunyikan
        }
    }

    function sendMessage() {
        const input = document.getElementById("chat-input");
        const chatMessages = document.getElementById("chat-messages");

        if (input.value.trim() !== "") {
            // Menambahkan pesan dari customer ke dalam chat
            const message = document.createElement("div");
            message.classList.add("message", "customer");
            message.textContent = input.value;
            chatMessages.appendChild(message);

            // Menambahkan balasan otomatis dari customer service
            const reply = document.createElement("div");
            reply.classList.add("message", "support");
            reply.textContent = "Terima kasih, kami akan segera membantu!";
            chatMessages.appendChild(reply);

            // Scroll ke bawah agar pesan terbaru terlihat
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Kosongkan input
            input.value = "";
        }
    }

    // Fungsi untuk menutup chat box saat tombol silang diklik
    function closeChat() {
        const chatBox = document.getElementById("chat-box");
        const chatBubble = document.getElementById("chat-bubble");

        chatBox.classList.remove("show");
        setTimeout(() => {
            chatBox.classList.add("hidden"); // Menyembunyikan chat box setelah animasi selesai
        }, 300);

        chatBubble.classList.remove("hidden"); // Menampilkan bubble chat
    }


    function adjustChatPosition() {
        const bubble = document.getElementById("chat-bubble");
        const chatBox = document.getElementById("chat-box");
        const footer = document.getElementById("footer");

        const footerRect = footer.getBoundingClientRect();
        const bubbleHeight = bubble.offsetHeight;
        const chatBoxHeight = chatBox.offsetHeight;
        const safeMargin = 40;

        const bottomSpace = window.innerHeight - footerRect.top;

        if (bottomSpace > 0) {
            // Footer mulai masuk layar, geser bubble ke atas agar tidak menimpa
            const offset = bottomSpace + safeMargin;

            bubble.style.position = 'fixed';
            bubble.style.bottom = `${offset}px`;

            chatBox.style.position = 'fixed';
            chatBox.style.bottom = `${offset + bubbleHeight + 10}px`;
        } else {
            // Footer belum kelihatan, posisi default
            bubble.style.position = 'fixed';
            bubble.style.bottom = `${safeMargin}px`;

            chatBox.style.position = 'fixed';
            chatBox.style.bottom = `${bubbleHeight + safeMargin + 10}px`;
        }
    }

    window.addEventListener('scroll', adjustChatPosition);
    window.addEventListener('resize', adjustChatPosition);
    document.addEventListener('DOMContentLoaded', adjustChatPosition);
</script>
