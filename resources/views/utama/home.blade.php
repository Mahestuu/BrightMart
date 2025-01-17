@extends('utama.app')

@section('title')
    
@section('content')

    <section class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="{{asset('image/belanja4.png')}}" alt="Gambar 1">
            </div>
            <div class="carousel-slide">
                <img src="{{asset('image/belanja3.jpg')}}" alt="Gambar 2">
            </div>
            <div class="carousel-slide">
                <img src="{{asset('image/belanja1.jpeg')}}" alt="Gambar 3">
            </div>
            <div class="carousel-slide">
                <img src="{{asset('image/belanja5.png')}}" alt="Gambar 4">
            </div>
            <div class="carousel-slide">
                <img src="{{asset('image/belanja6.png')}}" alt="Gambar 5">
            </div>
        </div>
        <!-- Tombol Slide -->
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </section>
    

    <div class="container">  
        <section class="hero-section">
            <div data-aos="fade-down" class="hero-image">
                <img src="{{asset('image/belanja6.png')}}" alt="Produk">
            </div>
            <div class="hero-content">
                <h1 data-aos="fade-down">Berbagai Produk Bisa Kamu Nikmati</h1>
                <p data-aos="fade-down">BrightMart menyediakan berbagai macam produk hingga makanan dan minuman pilihan, dijaga dengan berkualitas sehingga lezat untuk kamu nikmati.</p>
                <a data-aos="fade-down" href="produk.html">SELENGKAPNYA ➔</a>
            </div>
        </section>
    </div>

    <section class="potensi-section">
        <div class="potensi-content">
            <h1 data-aos="fade-down" >Kembangkan Potensimu! <br> <span>Bersama Kami!</span></h1>
            <p data-aos="fade-down" >Jadilah bagian dari tim inovatif kami yang merangkul seluruh kemampuan untuk berkembang bersama. Bergabung dengan BrightMart, buka potensimu, dan ciptakan perubahan.</p>
            <a data-aos="fade-down"  href="karir.html">SELENGKAPNYA ➔</a>
        </div>
        <div data-aos="fade-down" class="potensi-image">
            <img src="{{asset('image/people.png')}}" alt="karyawan" id="karyawan-img">
        </div>
    </section>

    <div class="bright-tips-section">
        <h2 data-aos="fade-down" >Bright Tips</h2>
        <p data-aos="fade-down" >Temukan berita dan tips menarik untuk menunjang keseharianmu!</p>
        
        <div class="tips-cards">
            <!-- Card 1 -->
            <div data-aos="fade-down" class="tip-card">
                <img src="{{asset('image/olahraga.jpg')}}" alt="Tips 1">
                <div class="tip-content">
                    <h3>Jaga Kesehatanmu!</h3>
                    <p>Cara mudah untuk menjaga kesehatan selama aktivitas harian.</p>
                    <a href="#">Baca Selengkapnya</a>
                </div>
            </div>
    
            <!-- Card 2 -->
            <div data-aos="fade-down" data-aos-delay="500" class="tip-card">
                <img src="{{asset('image/kelola-uang.jpg')}}" alt="Tips 2">
                <div class="tip-content">
                    <h3>Mengelola Keuangan</h3>
                    <p>Tips hemat untuk mengelola keuangan bulanan Anda.</p>
                    <a href="#">Baca Selengkapnya</a>
                </div>
            </div>
    
            <!-- Card 3 -->
            <div data-aos="fade-down" data-aos-delay="700" class="tip-card">
                <img src="{{asset('image/kebugaran.jpg')}}" alt="Tips 3">
                <div class="tip-content">
                    <h3>Menjaga Kebugaran</h3>
                    <p>Langkah-langkah untuk menjaga kebugaran tubuh dengan latihan ringan.</p>
                    <a href="#">Baca Selengkapnya</a>
                </div>
            </div>
    
            <!-- Card lainnya dapat ditambahkan sesuai kebutuhan -->
        </div>
    </div>

<script>
        // JavaScript untuk membuat animasi naik-turun
    const karyawanImg = document.getElementById("karyawan-img");
    let direction = 1;
    let position = 0;

    const speed = 0.1; // Kecepatan yang lebih lambat
    const maxDisplacement = 10; // Batas gerakan (atas dan bawah)

    function animateImage() {
        position += direction * speed; // Kecepatan gerakan
        karyawanImg.style.transform = `translateY(${position}px)`;

        // Mengubah arah ketika mencapai batas tertentu
        if (position >= 10 || position <= -10) {
            direction *= -1;
        }

        requestAnimationFrame(animateImage); // Memanggil fungsi animasi berulang
    }

    // Mulai animasi
    animateImage();


    let slideIndex = 0; // Mulai dari slide pertama
    const slides = document.querySelectorAll(".carousel-slide");

    function moveSlide(n) {
        slideIndex += n;

        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }

        if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }
        // Geser slide
        const carouselContainer = document.querySelector('.carousel-container');
        const slideWidth = slides[0].clientWidth;
        carouselContainer.style.transform = `translateX(${-slideIndex * slideWidth}px)`;
    }

    //untuk menggeser slide setelah beberapa detik
    setInterval(function () {
        moveSlide(1);
    }, 5000); // Ganti gambar setiap 5 detik

    AOS.init();

</script>

@endsection