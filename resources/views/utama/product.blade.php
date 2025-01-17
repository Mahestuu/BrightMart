@extends('utama.app')
@section('content')
    <div class="judul-product" data-aos="fade-down" data-aos-delay="500">
        <h2>Beragam Produk Yang Kami Jual Untuk Anda</h2>
        <p>Makanan dan minuman berkualitas serta produk lainnya dapat meningkatkan pengalaman sehari-hari Anda. Dengan berbagai pilihan produk dari kami, Anda dapat menemukan semua yang Anda butuhkan untuk memenuhi kebutuhan sehari-hari</p>
    </div>
    
    <section class="products" data-aos="zoom-in-right" data-aos-delay="500">
        <h2>Produk Terlaris</h2>
            <div class="container">
                <div class="product-scroll">
                    <div class="product-grid">
                        <div class="product-card">
                            <img src="{{asset('image/10000020_thumb.jpg')}}" alt="Produk 1">
                            <h3>Indomilk Kental Manis Chocolate 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 10.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/10000088_thumb.jpg')}}" alt="Produk 2">
                            <h3>Frisian Flag Kental Manis Coklat 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 15.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/10021008_thumb.jpg')}}" alt="Produk 3">
                            <h3>Gulaku Gula Tebu (Kuning) 1000G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 20.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/20092710_thumb.jpg')}}" alt="Produk 4">
                            <h3>Indomaret Beras Pulen Wangi Premium 5Kg</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/20121514_thumb.jpg')}}" alt="Produk 4">
                            <h3>Le Minerale Air Mineral 15L</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/20032058_thumb.jpg')}}" alt="Produk 4">
                            <h3>Frisian Flag Kental Manis 6X38G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/10036665_thumb.jpg')}}" alt="Produk 4">
                            <h3>Carnation Krimer Kental Manis 365G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/20124726_thumb.jpg')}}" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i>   Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="products" data-aos="zoom-in-right" data-aos-delay="500" >
        <h2>Cemilan</h2>
            <div class="container">
                <div class="product-scroll">
                    <div class="product-grid">
                        <div class="product-card">
                            <img src="{{asset('image/masterpotato.jpg')}}" alt="Produk 1">
                            <h3>Indomilk Kental Manis Chocolate 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 10.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/maxcorn.jpg')}}" alt="Produk 2">
                            <h3>Frisian Flag Kental Manis Coklat 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 15.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/guribee.jpg')}}" alt="Produk 3">
                            <h3>Gulaku Gula Tebu (Kuning) 1000G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 20.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/potabee.jpg')}}" alt="Produk 4">
                            <h3>Indomaret Beras Pulen Wangi Premium 5Kg</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/qtela-pedas.jpg')}}" alt="Produk 4">
                            <h3>Le Minerale Air Mineral 15L</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/chikiballs.jpg')}}" alt="Produk 4">
                            <h3>Frisian Flag Kental Manis 6X38G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/chuba2.jpg')}}" alt="Produk 4">
                            <h3>Carnation Krimer Kental Manis 365G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/pringles-bbq.webp')}}" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/pringles-ori.webp')}}" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/chitato-indomie.webp')}}" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="{{asset('image/chitato-ayambbq.jpg')}}" alt="Produk 4"">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="products" data-aos="zoom-in-right" data-aos-delay="500">
        <h2>Kebutuhan Pokok</h2>
            <div class="container">
                <div class="product-scroll">
                    <div class="product-grid">
                        <div class="product-card">
                            <img src="../Test 2/image/masterpotato.jpg" alt="Produk 1">
                            <h3>Indomilk Kental Manis Chocolate 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 10.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/maxcorn.jpg" alt="Produk 2">
                            <h3>Frisian Flag Kental Manis Coklat 370G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 15.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/guribee.jpg" alt="Produk 3">
                            <h3>Gulaku Gula Tebu (Kuning) 1000G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 20.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/potabee.jpg" alt="Produk 4">
                            <h3>Indomaret Beras Pulen Wangi Premium 5Kg</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/qtela-pedas.jpg" alt="Produk 4">
                            <h3>Le Minerale Air Mineral 15L</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/chikiballs.jpg" alt="Produk 4">
                            <h3>Frisian Flag Kental Manis 6X38G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/chuba2.jpg" alt="Produk 4">
                            <h3>Carnation Krimer Kental Manis 365G</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/pringles-bbq.webp" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/pringles-ori.webp" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/chitato-indomie.webp" alt="Produk 4">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i> Beli Sekarang</button>
                        </div>
                        <div class="product-card">
                            <img src="../Test 2/image/chitato-ayambbq.jpg" alt="Produk 4"">
                            <h3>Facial Tissue 2 Ply (2+1) 3X180's</h3>
                            <p>Deskripsi.</p>
                            <span class="price">Rp 25.000</span>
                            <button class="btn"><i class="fa-solid fa-cart-shopping"></i>   Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

</html>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection
