@extends('utama.app')


@section('content')
    <div class="judul-product" data-aos="fade-down" data-aos-delay="500">
        <h2>Beragam Produk Yang Kami Jual Untuk Anda</h2>
        <p>Makanan dan minuman berkualitas serta produk lainnya dapat meningkatkan pengalaman sehari-hari Anda. Dengan berbagai pilihan produk dari kami, Anda dapat menemukan semua yang Anda butuhkan untuk memenuhi kebutuhan sehari-hari</p>
    </div>
    
    @forelse($categories as $category)
        <section class="products" data-aos="zoom-in-right" data-aos-delay="500">
            <h2>{{ $category->category_name }}</h2>
            <div class="container">
                <div class="product-scroll">
                    <div class="product-grid">
                        @forelse($category->products as $product)
                            <div class="product-card">
                                <img src="{{ asset('products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                                <h3>{{ $product->product_name }}</h3>
                                <p>{{ $product->product_description }}</p>
                                <span class="price">Rp {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                @auth
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <input type="number" name="qty" value="1" min="1" max="{{ $product->product_stock }}" class="form-control mb-2" style="width: 80px;">
                                        <button type="submit" class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</a>
                                @endauth
                            </div>
                        @empty
                            <div class="text-center w-100">
                                <p>Tidak ada produk tersedia untuk kategori ini saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @empty
        <!-- Fallback jika tidak ada kategori -->
        <section class="products" data-aos="zoom-in-right" data-aos-delay="500">
            <h2>Semua Produk</h2>
            <div class="container">
                <div class="product-scroll">
                    <div class="product-grid">
                        @forelse($products as $product)
                            <div class="product-card">
                                <img src="{{ asset('products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                                <h3 class="">{{ $product->product_name }}</h3>
                                <p>{{ $product->product_description }}</p>
                                <span class="price">Rp {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                @auth
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <input type="number" name="qty" value="1" min="1" max="{{ $product->product_stock }}" class="form-control mb-2" style="width: 80px;">
                                        <button type="submit" class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</a>
                                @endauth
                            </div>
                        @empty
                            <div class="text-center w-100">
                                <p>Tidak ada produk tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @endforelse

</html>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection
