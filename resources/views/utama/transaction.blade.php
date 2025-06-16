@extends('utama.app')

@section('content')
    <div class="transaction-section" data-aos="fade-up" data-aos-delay="300">
        <div class="container">
            @if ($hasOrder)
                <!-- Header Pesanan -->
                <div class="transaction-header text-center mb-5" data-aos="zoom-in" data-aos-delay="400">
                    <h1 class="transaction-title">Terima Kasih atas Pesanan Anda!</h1>
                    <p class="transaction-subtitle">Pesanan #{{ str_pad($order->order_id, 6, '0', STR_PAD_LEFT) }} | {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <span class="badge bg-{{ $order->order_status === 'Pending' ? 'warning' : ($order->order_status === 'Processing' ? 'info' : ($order->order_status === 'Shipped' ? 'primary' : ($order->order_status === 'Delivered' ? 'success' : 'danger'))) }} text-white">
                        {{ $order->order_status }}
                    </span>
                </div>

                <!-- Timeline Status -->
                <div class="transaction-timeline mb-5" data-aos="fade-right" data-aos-delay="500">
                    <h3 class="mb-4">Status Pesanan</h3>
                    <div class="timeline">
                        <div class="timeline-item {{ $order->order_status === 'Pending' || $order->order_status === 'Processing' || $order->order_status === 'Shipped' || $order->order_status === 'Delivered' ? 'active' : '' }}">
                            <i class="fas fa-receipt timeline-icon"></i>
                            <div class="timeline-content">
                                <h5>Pending</h5>
                                <p>Pesanan diterima, menunggu konfirmasi.</p>
                            </div>
                        </div>
                        <div class="timeline-item {{ $order->order_status === 'Processing' || $order->order_status === 'Shipped' || $order->order_status === 'Delivered' ? 'active' : '' }}">
                            <i class="fas fa-cogs timeline-icon"></i>
                            <div class="timeline-content">
                                <h5>Processing</h5>
                                <p>Pesanan sedang diproses.</p>
                            </div>
                        </div>
                        <div class="timeline-item {{ $order->order_status === 'Shipped' || $order->order_status === 'Delivered' ? 'active' : '' }}">
                            <i class="fas fa-truck timeline-icon"></i>
                            <div class="timeline-content">
                                <h5>Shipped</h5>
                                <p>Pesanan sedang dikirim.</p>
                            </div>
                        </div>
                        <div class="timeline-item {{ $order->order_status === 'Delivered' ? 'active' : '' }}">
                            <i class="fas fa-check-circle timeline-icon"></i>
                            <div class="timeline-content">
                                <h5>Delivered</h5>
                                <p>Pesanan telah diterima.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="transaction-details mb-5" data-aos="fade-left" data-aos-delay="600">
                    <h3 class="mb-4">Detail Pesanan</h3>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-right">Harga Satuan</th>
                                            <th class="price text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderitems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('products/' . $item->product->product_image) }}" alt="{{ $item->product->product_name }}" class="transaction-product-img me-3">
                                                        <div>
                                                            <h5>{{ $item->product->product_name }}</h5>
                                                            <p class="text-muted">{{ $item->product->product_description }}</p>
                                                        </div>
                                                    </td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td class="price text-right">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="transaction-summary mb-5" data-aos="fade-up" data-aos-delay="700">
                    <h3 class="mb-4">Ringkasan Pembayaran</h3>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal Produk</span>
                                <span class="price">Rp {{ number_format($order->orderitems->sum(fn($item) => $item->price * $item->qty), 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Pengiriman</span>
                                <span class="price">Rp {{ number_format($order->total_amount - $order->orderitems->sum(fn($item) => $item->price * $item->qty), 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <strong>Total</strong>
                                <strong class="price">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="transaction-actions text-center" data-aos="zoom-in" data-aos-delay="800">
                    <a href="{{ route('home.index') }}" class="btn btn-primary me-2"><i class="fas fa-home"></i> Kembali ke Beranda</a>
                    <a href="{{ route('orders.history') }}" class="btn btn-outline-primary"><i class="fas fa-history"></i> Riwayat Pesanan</a>
                </div>
            @else
                <!-- Pesan Tidak Ada Transaksi -->
                <div class="no-transaction text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-shopping-cart no-transaction-icon mb-3"></i>
                            <h3 class="no-transaction-title">Belum Ada Transaksi</h3>
                            <p class="no-transaction-subtitle">Yuk, mulai belanja kebutuhanmu di BrightMart!</p>
                            <a href="{{ route('product') }}" class="btn btn-primary mt-3"><i class="fas fa-store"></i> Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection