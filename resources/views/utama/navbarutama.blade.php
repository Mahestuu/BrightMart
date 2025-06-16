<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BrightMart</title>
    
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2980b9;
            --hover-yellow: #f9cf1d;
            --text-white: #ffffff;
            --text-dark: #2c3e50;
        }

        .navbar-brightmart {
            background-color: var(--primary-blue);
            padding: 0;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            height: 55px;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--text-white) !important;
            font-weight: 500;
            margin: 0 5px;
            padding: 8px 12px !important;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--hover-yellow);
            color: var(--text-dark) !important;
        }

        .btn-brightmart {
            background-color: var(--hover-yellow);
            color: var(--text-dark);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-brightmart:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-brightmart {
            border: 2px solid var(--text-white);
            color: var(--text-white);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-brightmart:hover {
            background-color: var(--text-white);
            color: var(--primary-blue);
        }

        .cart-icon {
            position: relative;
            color: var(--text-white);
            font-size: 1.2rem;
            margin-left: 20px;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            color: var(--hover-yellow);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Right-aligned navigation */
        .navbar-nav {
            width: 100%;
            justify-content: flex-end;
            align-items: center;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: var(--primary-blue);
                padding: 15px;
                border-radius: 0;
                margin-top: 10px;
            }

            .nav-link {
                margin: 5px 0;
                padding: 10px 15px !important;
            }

            .btn-container {
                margin-top: 15px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .cart-icon {
                margin-left: 0;
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-brightmart">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    <img src="{{ asset('image/logo-brightmart.png') }}" alt="BrightMart Logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarBrightmart">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarBrightmart">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/product">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/lokasitoko">Lokasi Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/karir">Karir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="docs/api">API</a>
                        </li>

                        <!-- Cart Icon as part of nav -->
                        <li class="nav-item d-lg-none">
                            <a href="/cart" class="nav-link">
                                <i class="fas fa-shopping-cart me-1"></i> Keranjang
                                <span class="cart-count">{{ \App\Models\cart::where('user_id', Auth::id())->count() }}</span>
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        <!-- Cart Icon for desktop -->
                        <a href="/cart" class="cart-icon d-none d-lg-block text-decoration-none">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">{{ \App\Models\cart::where('user_id', Auth::id())->count() }}</span>
                        </a>

                        @auth
                            <div class="dropdown ms-3">
                                <button class="btn btn-outline-brightmart dropdown-toggle" type="button" id="userDropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="/"><i class="fas fa-user me-2"></i> Profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('orders.history') }}"><i class="fas fa-box me-2"></i> Daftar Transaksi</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="/login" class="btn btn-outline-brightmart ms-3">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk
                            </a>
                            <a href="/register" class="btn btn-brightmart ms-2">
                                <i class="fas fa-user-plus me-1"></i> Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="strip-kuning"></div>

    <!-- Bootstrap 5.3.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        // Custom dropdown toggle
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdown = button.parentElement;
                const menu = button.nextElementSibling;
                const isOpen = menu.classList.contains('show');

                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
                
                // Toggle current dropdown
                if (!isOpen) {
                    menu.classList.add('show');
                    console.log('Dropdown opened');
                } else {
                    menu.classList.remove('show');
                    console.log('Dropdown closed');
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function closeDropdown(event) {
                    if (!dropdown.contains(event.target)) {
                        menu.classList.remove('show');
                        document.removeEventListener('click', closeDropdown);
                        console.log('Dropdown closed (outside click)');
                    }
                }, { once: true });
            });
        });
    </script>
</body>

</html>