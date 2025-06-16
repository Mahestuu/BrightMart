<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - BrightMart</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #2980b9;
            --hover-yellow: #f9cf1d;
            --text-dark: #2c3e50;
            --accent-gray: #f8f9fa;
            --error-red: #e74c3c;
            --success-green: #2ecc71;
        }

        body {
            background-color: var(--accent-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-container {
            padding: 50px 0;
            min-height: 80vh;
        }

        .cart-header {
            background: linear-gradient(135deg, var(--primary-blue), #3498db);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            margin-bottom: 0;
        }

        .cart-card {
            background: white;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s;
        }

        .cart-item:hover {
            background-color: #f1f3f5;
        }

        .cart-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-details {
            flex: 1;
        }

        .cart-details h5 {
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .cart-details .price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-blue);
        }

        .qty-input {
            width: 80px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 5px;
            transition: border-color 0.3s;
        }

        .qty-input:focus {
            border-color: var(--hover-yellow);
            box-shadow: 0 0 5px rgba(249, 207, 29, 0.3);
        }

        .btn-remove {
            background: transparent;
            border: none;
            color: var(--error-red);
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .btn-remove:hover {
            color: #c0392b;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .summary-card h4 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .summary-item .label {
            color: #6c757d;
        }

        .summary-item .value {
            color: var(--text-dark);
            font-weight: 500;
        }

        .btn-checkout {
            background: var(--hover-yellow);
            color: var(--text-dark);
            font-weight: 600;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-checkout:hover {
            background: #e6b800;
            transform: translateY(-2px);
        }

        .empty-cart {
            text-align: center;
            padding: 100px 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .empty-cart i {
            font-size: 3.5rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            color: var(--text-dark);
            font-weight: 600;
        }

        .empty-cart .btn {
            background: var(--primary-blue);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .empty-cart .btn:hover {
            background: #1b6a9b;
        }

        .delivery-options, .address-input {
            margin-bottom: 20px;
        }

        .form-select, .form-control {
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--hover-yellow);
            box-shadow: 0 0 5px rgba(249, 207, 29, 0.3);
        }

        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-img {
                margin-bottom: 15px;
            }

            .qty-input {
                width: 100%;
            }

            .summary-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    @include('utama.navbarutama')

    <div class="container cart-container" data-aos="fade-up" data-aos-delay="100">
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Keranjang Kosong -->
        @if ($cartItems->isEmpty())
            <div class="empty-cart" data-aos="zoom-in" data-aos-delay="200">
                <i class="fas fa-shopping-cart"></i>
                <h3>Keranjang belanjamu masih kosong</h3>
                <p>Yuk, cari produk yang kamu mau di BrightMart</p>
                <a href="/product" class="btn">Cari Produk</a>
            </div>
        @else
            <!-- Header Keranjang -->
            <div class="cart-header">
                <h3 class="mb-0">Keranjang Belanja</h3>
            </div>

            <!-- Daftar Item Keranjang -->
            <div class="cart-card">
                @foreach ($cartItems as $item)
                    <div class="cart-item" data-aos="fade-right" data-aos-delay="{{ $loop->index * 100 }}">
                        <img src="{{ asset('products/' . $item->product->product_image) }}"
                             alt="{{ $item->product->product_name }}" class="cart-img">
                        <div class="cart-details">
                            <h5>{{ $item->product->product_name }}</h5>
                            <p class="price">Rp {{ number_format($item->product->product_price, 0, ',', '.') }}</p>
                        </div>
                        <input type="number" class="qty-input" value="{{ $item->qty }}" min="1"
                               max="{{ $item->product->product_stock }}"
                               data-cart-id="{{ $item->cart_id }}"
                               data-price="{{ $item->product->product_price }}"
                               aria-label="Jumlah produk">
                        <form action="{{ route('cart.remove', $item->cart_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove" aria-label="Hapus item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Ringkasan dan Checkout -->
            <div class="summary-card" data-aos="fade-left" data-aos-delay="300">
                <h4>Ringkasan Belanja</h4>
                <div class="delivery-options">
                    <label for="deliveryType" class="form-label">Tipe Pemesanan</label>
                    <select class="form-select" id="deliveryType" name="delivery_type" required>
                        <option value="delivery">Pengiriman</option>
                        <option value="pickup">Ambil di Toko</option>
                    </select>
                </div>
                <div class="address-input" id="addressInput">
                    <label for="deliveryAddress" class="form-label">Alamat Pengiriman</label>
                    <textarea class="form-control" id="deliveryAddress" name="delivery_address" rows="3"
                              placeholder="Masukkan alamat lengkap..." required></textarea>
                </div>
                <hr>
                <div class="summary-item">
                    <span class="label">Harga Barang</span>
                    <span class="value" id="subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Diskon Produk</span>
                    <span class="value" id="discount">Rp 0</span>
                </div>
                <div class="summary-item">
                    <span class="label">Biaya Pengiriman</span>
                    <span class="value" id="shipping">Rp 10,000</span>
                </div>
                <hr>
                <div class="summary-item">
                    <span class="label"><strong>Total</strong></span>
                    <span class="value" id="total">Rp {{ number_format($total + 10000, 0, ',', '.') }}</span>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                    @csrf
                    <input type="hidden" name="delivery_type" id="hiddenDeliveryType">
                    <input type="hidden" name="delivery_address" id="hiddenDeliveryAddress">
                    <button type="submit" class="btn btn-warning  w-100">Checkout</button>
                </form>
            </div>
        @endif
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Update qty secara real-time
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', async function () {
                const cartId = this.dataset.cartId;
                const qty = parseInt(this.value);
                const price = parseFloat(this.dataset.price);
                const max = parseInt(this.max);
                const originalValue = this.defaultValue;

                // Validasi jumlah
                if (isNaN(qty) || qty < 1 || qty > max) {
                    alert('Jumlah tidak valid! Harap masukkan angka antara 1 dan ' + max);
                    this.value = originalValue;
                    return;
                }

                try {
                    const response = await fetch(`/cart/update/${cartId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ qty })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Gagal memperbarui jumlah');
                    }

                    // Update default value setelah sukses
                    this.defaultValue = qty;

                    // Update ringkasan harga
                    updateSummary();

                    // Tampilkan pesan sukses (opsional)
                    console.log(data.success || 'Jumlah diperbarui!');
                } catch (error) {
                    console.error('Error:', error.message);
                    alert('Gagal memperbarui jumlah: ' + error.message);
                    this.value = originalValue;
                }
            });
        });

        // Fungsi untuk memperbarui ringkasan harga
        function updateSummary() {
            let subtotal = 0;
            document.querySelectorAll('.qty-input').forEach(input => {
                const qty = parseInt(input.value) || 0;
                const price = parseFloat(input.dataset.price) || 0;
                subtotal += qty * price;
            });

            const shipping = document.getElementById('deliveryType').value === 'delivery' ? 10000 : 0;
            const discount = 0; // Asumsi diskon 0
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            document.getElementById('discount').textContent = `Rp ${discount.toLocaleString('id-ID')}`;
            document.getElementById('shipping').textContent = `Rp ${shipping.toLocaleString('id-ID')}`;
            document.getElementById('total').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Tangani perubahan tipe pemesanan
        const deliveryType = document.getElementById('deliveryType');
        const addressInput = document.getElementById('addressInput');
        deliveryType.addEventListener('change', function () {
            addressInput.style.display = this.value === 'delivery' ? 'block' : 'none';
            updateSummary();
        });

        // Inisialisasi visibilitas alamat
        if (deliveryType.value !== 'delivery') {
            addressInput.style.display = 'none';
        }

        // Kirim data tipe pemesanan dan alamat saat checkout
        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            document.getElementById('hiddenDeliveryType').value = deliveryType.value;
            document.getElementById('hiddenDeliveryAddress').value = document.getElementById('deliveryAddress').value;
        });
    </script>
</body>
</html>