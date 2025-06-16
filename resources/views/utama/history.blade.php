<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrightMart - Riwayat Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    <style>
        /* History Section */
        .history-section {
            padding: 60px 0;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        /* Header */
        .history-header {
            margin-bottom: 40px;
        }

        .history-title {
            font-family: 'Gotham', sans-serif;
            font-size: 3rem;
            color: #2980b9;
            font-weight: 700;
            letter-spacing: 1px;
            text-align: center;
        }

        .history-subtitle {
            font-size: 1.2rem;
            color: #666;
            font-weight: 400;
            text-align: center;
        }

        /* Navbar */
        header {
            background-color: #2980b9;
            padding: 15px 0;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container-nav {
            width: 90%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-left: 20px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #f9cf1d;
        }

        .cart-btn {
            background-color: #f9cf1d;
            border: none;
            border-radius: 50%;
            padding: 5px;
            color: #2980b9;
            font-size: 1.2rem;
            position: relative;
        }

        .cart-btn .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #d32f2f;
            color: white;
            font-size: 0.7rem;
            padding: 2px 5px;
            border-radius: 50%;
        }

        .dropdown-menu {
            background-color: #2980b9;
        }

        .dropdown-item {
            color: white;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #0056b3;
        }

        /* Filter dan Pencarian */
        .history-filter .btn-outline-primary {
            border-color: #2980b9;
            color: #2980b9;
            font-size: 0.95rem;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .history-filter .btn-outline-primary.active,
        .history-filter .btn-outline-primary:hover {
            background-color: #2980b9;
            color: white;
        }

        .history-filter .form-control {
            border-radius: 25px;
            border: 1px solid #d4dde6;
            font-size: 0.95rem;
            padding: 10px 20px;
            transition: border-color 0.2s ease;
        }

        .history-filter .form-control:focus {
            border-color: #2980b9;
            box-shadow: 0 0 0 0.25rem rgba(41, 128, 185, 0.1);
        }

        .history-filter .btn-primary {
            border-radius: 20px;
            padding: 10px 20px;
        }

        /* List Transaksi */
        .history-list .history-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            background-color: #fff;
        }

        .history-list .history-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .history-card-title {
            font-size: 1.3rem;
            color: #333;
            font-weight: 600;
        }

        .history-card-date {
            font-size: 0.9rem;
            color: #666;
        }

        .history-card-total {
            font-size: 1.1rem;
            font-weight: bold;
            color: #d32f2f;
        }

        .history-card-actions .btn-sm {
            padding: 8px 16px;
            font-size: 0.9rem;
            background-color: #2980b9;
            border-color: #2980b9;
            transition: background-color 0.3s ease;
        }

        .history-card-actions .btn-sm:hover {
            background-color: #0056b3;
        }

        /* No Transaction */
        .no-transaction {
            padding: 40px 0;
        }

        .no-transaction-icon {
            font-size: 4rem;
            color: #2980b9;
            display: inline-block;
        }

        .no-transaction-title {
            font-family: 'Gotham', sans-serif;
            font-size: 2rem;
            color: #333;
            margin-bottom: 15px;
        }

        .no-transaction-subtitle {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 25px;
        }

        .no-transaction .btn-primary {
            padding: 12px 30px;
            font-size: 1rem;
            background-color: #2980b9;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .no-transaction .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #2980b9;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        .footer-content {
            font-size: 0.9rem;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            .history-title {
                font-size: 2.5rem;
            }

            nav ul {
                flex-direction: column;
                align-items: flex-start;
                margin-top: 10px;
            }

            nav ul li {
                margin-left: 0;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 768px) {
            .history-section {
                padding: 40px 0;
            }

            .history-title {
                font-size: 2rem;
            }

            .history-subtitle {
                font-size: 1rem;
            }

            .history-card-title {
                font-size: 1.2rem;
            }

            .history-card-date {
                font-size: 0.85rem;
            }

            .history-card-total {
                font-size: 1rem;
            }

            .history-card-actions .btn-sm {
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            .no-transaction-icon {
                font-size: 3rem;
            }

            .no-transaction-title {
                font-size: 1.8rem;
            }

            .no-transaction-subtitle {
                font-size: 1rem;
            }

            .no-transaction .btn-primary {
                font-size: 0.9rem;
                padding: 10px 20px;
            }

            .container-nav {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .history-title {
                font-size: 1.8rem;
            }

            .history-filter .form-control {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .history-filter .btn-primary {
                padding: 8px 15px;
            }

            .no-transaction-icon {
                font-size: 2.5rem;
            }

            .no-transaction-title {
                font-size: 1.5rem;
            }

            .no-transaction-subtitle {
                font-size: 0.9rem;
            }

            .footer-content {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
   @include('utama.navbarutama')


    <!-- Konten Utama -->
    <div class="history-section" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <!-- Header -->
            <div class="history-header text-center mb-5" data-aos="zoom-in" data-aos-delay="300">
                <h1 class="history-title">Riwayat Transaksi</h1>
                <p class="history-subtitle">Pantau semua pesanan Anda di BrightMart dengan mudah</p>
            </div>

            @if ($orders->isEmpty())
                <!-- Pesan Tidak Ada Transaksi -->
                <div class="no-transaction text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="no-transaction-icon mb-3">
                                <i class="fas fa-shopping-cart animate__animated animate__swing"></i>
                            </div>
                            <h3 class="no-transaction-title">Belum Ada Transaksi</h3>
                            <p class="no-transaction-subtitle">Yuk, mulai belanja kebutuhanmu di BrightMart dan lacak
                                pesananmu di sini!</p>
                            <a href="{{ route('product.index') }}" class="btn btn-primary mt-3"><i
                                    class="fas fa-store me-1"></i> Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Filter dan Pencarian -->
                <div class="history-filter mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="btn-group" role="group" aria-label="Filter Status">
                                <button type="button"
                                    class="btn btn-outline-primary status-filter {{ request('status') == '' ? 'active' : '' }}"
                                    data-status="">Semua</button>
                                <button type="button"
                                    class="btn btn-outline-primary status-filter {{ request('status') == 'Pending' ? 'active' : '' }}"
                                    data-status="Pending">Pending</button>
                                <button type="button"
                                    class="btn btn-outline-primary status-filter {{ request('status') == 'Processing' ? 'active' : '' }}"
                                    data-status="Processing">Processing</button>
                                <button type="button"
                                    class="btn btn-outline-primary status-filter {{ request('status') == 'Shipped' ? 'active' : '' }}"
                                    data-status="Shipped">Shipped</button>
                                <button type="button"
                                    class="btn btn-outline-primary status-filter {{ request('status') == 'Delivered' ? 'active' : '' }}"
                                    data-status="Delivered">Delivered</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('orders.history') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Cari nomor pesanan..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Daftar Transaksi -->
                <div class="history-list row" data-aos="fade-up" data-aos-delay="500">
                    @foreach ($orders as $order)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="history-card card h-100 shadow-sm" data-aos="fade-up"
                                data-aos-delay="{{ 100 * $loop->iteration }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="history-card-title mb-0">
                                            #{{ str_pad($order->order_id, 6, '0', STR_PAD_LEFT) }}</h5>
                                        <span
                                            class="badge bg-{{ $order->order_status === 'Pending' ? 'warning' : ($order->order_status === 'Processing' ? 'info' : ($order->order_status === 'Shipped' ? 'primary' : ($order->order_status === 'Delivered' ? 'success' : 'danger'))) }} text-white">
                                            {{ $order->order_status }}
                                        </span>
                                    </div>
                                    <p class="history-card-date text-muted"><i
                                            class="fas fa-calendar-alt me-2"></i>{{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                    <p class="history-card-total price"><i class="fas fa-wallet me-2"></i>Rp
                                        {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                    <div class="history-card-actions mt-3">
                                        <a href="{{ route('order.show', $order->order_id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-eye me-1"></i> Lihat
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

     @include('utama.footerutama')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800
        });
        document.querySelectorAll('.status-filter').forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                const url = new URL(window.location);
                url.searchParams.set('status', status);
                window.location.href = url.toString();
            });
        });
    </script>
</body>

</html>
