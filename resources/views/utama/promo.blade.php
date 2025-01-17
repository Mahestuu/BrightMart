@extends('utama.app')

@section('content')

    <section class="promo-banner">
        <img alt="WOW PROMO" src="{{asset('image/wow_promo.png')}}"/>
    </section>

    {{-- <div class="judul-promo">
        <h2 data-aos="fade-down" data-aos-delay="300">Promo</h2>
    </div> --}}

    <div class="mt-4">
        <section class="promo-grid">
            <div class="promo-card" data-aos="flip-right" data-aos-delay="300">
                <img src="{{asset('image/10003517_thumb.jpg')}}" alt="Promo 1">
                <h2>Indomilk Kental Manis Chocolate 370G</h2>
                <p>Beli Produk Ini Sebanyak 2 Dapatkan Potongan Rp 5.000</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="400">
                <img src="https://storage.googleapis.com/a1aa/image/hC0meDE4tfrR4kiaidlATkxfF5Ku9MeWxrz2kXVEQ5WiGnFQB.jpg" alt="Promo 2">
                <h2>Kartika Toast Bagelan Cheese 78g</h2>
                <p>Beli Produk Ini Sebanyak 1 Dapatkan Gratis 1 Produk</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="500">
                <img src="{{asset('image/20106173_thumb.jpg')}}" alt="Promo 3">
                <h2>Indomie Mi Instan Goreng Plus Special 80g</h2>
                <p>Beli Sebanyak 6 Dapatkan Seharga Rp 16.500</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="600">
                <img src="{{asset('image/20124726_thumb.jpg')}}" alt="Promo 4">
                <h2>Indomaret Facial Tissue 2 Ply (2+1) 3X180's</h2>
                <p>Beli Produk Ini Sebanyak 2 Dapatkan 1 Produk Gratis</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="700">
                <img src="{{asset('image/20068906_thumb.jpg')}}" alt="Promo 5">
                <h2>Gery Crackers Malkist Salut Keju 100G</h2>
                <p>Beli Produk Ini Sebanyak 2 Dapatkan Potongan Rp 5.000.</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="300">
                <img src="{{asset('image/20101932_thumb.jpg')}}" alt="Promo 6">
                <h2>Kahf Skin Face Wash Energizing Bright 100mL</h2>
                <p>Harga Special! Rp 32.500</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="400">
                <img src="{{asset('image/20101932_thumb.jpg')}}" alt="Promo 6">
                <h2>Pepsodent Action 123 Pasta Gigi Herbal 190G</h2>
                <p>Harga Awal Rp 24.000 Menjadi Rp 14.900 Saja!</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="500">
                <img src="{{asset('image/20101932_thumb.jpg')}}" alt="Promo 6">
                <h2>Frisian Flag Kental Manis Cokelat 545G</h2>
                <p>Beli Produk Ini Sebanyak 4 Hanya Rp 50.000</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="600">
                <img src="{{asset('image/20101932_thumb.jpg')}}" alt="Promo 6">
                <h2>Promo Produk 6</h2>
                <p>Deskripsi singkat tentang promo produk 6.</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
            <div class="promo-card" data-aos="flip-right" data-aos-delay="700">
                <img src="{{asset('image/20101932_thumb.jpg')}}" alt="Promo 6">
                <h2>Promo Produk 6</h2>
                <p>Deskripsi singkat tentang promo produk 6.</p>
                <a href="#" class="btn-promo">Lihat Detail</a>
            </div>
        </section>
    </div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


@endsection
