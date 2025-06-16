<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrightMart - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-color: #5a5c69;
        }

        body {
            background-color: var(--secondary-color);
            height: 100vh;
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Bagian Kiri (Branding) */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            min-width: 400px;
        }

        .brand-content {
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Bagian Kanan (Form) */
        .login-form-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            min-width: 400px;
        }

        .login-form {
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.8s ease-in-out;
        }

        .brand-logo {
            width: 200px;
            height: auto;
            margin-bottom: 2rem;
            transform-style: preserve-3d;
            backface-visibility: hidden;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            will-change: transform;

            animation: breath 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            transition: all 0.3s ease;
        }

        .brand-logo:hover {
            animation: breath 3s ease-in-out infinite, float 5s ease-in-out infinite;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.15));
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .brand-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 3rem;
        }

        /* Form Styles */
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 1.2rem;
            border: 1px solid #d1d3e2;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: var(--text-color);
            transition: all 0.3s;
            pointer-events: none;
            background-color: white;
            padding: 0 5px;
        }

        .floating-label input:focus+label,
        .floating-label input:not(:placeholder-shown)+label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: var(--primary-color);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-color);
        }

        .password-toggle:hover {
            color: var(--accent-color);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes breath {

            0%,
            100% {
                transform: scale(1) translateZ(0);
            }

            50% {
                transform: scale(1.08) translateZ(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.2;
            }

            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            body {
                flex-direction: column;
            }

            .login-branding,
            .login-form-container {
                min-width: 100%;
                padding: 2rem 1rem;
            }

            .login-branding {
                position: relative;
                overflow: hidden;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .login-branding::after {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(78, 115, 223, 0.1) 0%, rgba(78, 115, 223, 0) 70%);
                animation: pulse 8s linear infinite;
                z-index: 0;
            }

            .brand-content {
                position: relative;
                z-index: 1;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Bagian Kiri - Branding -->
    <div class="login-branding">
        <div class="brand-content">
            <img src="{{ asset('image/logo-brightmart.png') }}" alt="BrightMart Logo" class="brand-logo">
            <h1 class="brand-title">Selamat Datang</h1>
            <p class="brand-subtitle">Silahkan Daftar Untuk Akun BrightMart Anda</p>

            <!-- Additional Brand Elements -->
            <div class="brand-features">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle me-2" style="font-size: 1.2rem;"></i>
                    <span>Belanja Mudah, Cepat, Dan Aman</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle me-2" style="font-size: 1.2rem;"></i>
                    <span>24/7 Customer Support</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2" style="font-size: 1.2rem;"></i>
                    <span>Pengiriman cepat dan dapat diandalkan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Kanan - Form Login -->
    <div class="login-form-container">
        <div class="login-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h2 class="mb-4 text-center">Buat Akun </h2>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!-- Email Input -->
                <div class="floating-label mt-3 mb-4">
                    <input type="text" class="form-control" id="name" name="name" placeholder=" " required
                        autofocus>
                    <label for="name"><i class="fas fa-user input-icon"></i> Nama Lengkap</label>
                </div>

                <div class="floating-label mb-4">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                    <label for="email"><i class="fas fa-envelope input-icon"></i> Alamat Email</label>
                </div>

                <!-- Password Input -->
                <div class="floating-label">
                    <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                    <label for="password"><i class="fas fa-lock input-icon"></i> Password</label>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="far fa-eye"></i>
                    </span>
                </div>

                <div class="floating-label mb-4">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="" required>
                    <label for="password_confirmation"><i class="fas fa-lock input-icon"></i> Confirm Password</label>
                    <span class="password-toggle" onclick="togglePassword_1()">
                        <i class="far fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="btn btn-primary btn-login mb-3">
                    <i class="fas fa-user-plus me-2"></i> Daftar
                </button>

                <div class="text-center">
                    <p class="mb-0">Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </p>

                    <!-- Register Link -->
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('.password-toggle i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function togglePassword_1() {
            const password = document.getElementById('password_confirmation');
            const icon = document.querySelector('.password-toggle i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Form Submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Signing in...';
            btn.disabled = true;

            const logo = document.querySelector('.brand-logo');

            logo.addEventListener('mouseenter', () => {
                logo.style.transform = 'scale(1.1)';
            });

            logo.addEventListener('mouseleave', () => {
                logo.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>
