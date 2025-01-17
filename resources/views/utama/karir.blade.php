@extends('utama.app')
@section('content')

    <div class="join-us-section" data-aos="zoom-in" data-aos-delay="500">
        <div class="image-container">
            <img src="{{asset('image/career-removebg-preview.png')}}" alt="Karyawan">
        </div>
        <div class="text-content">
            <h2>Gabung Bersama Kami!</h2>
            <p>Lihat di sini seluruh lowongan pekerjaan yang tersedia. Pilih sesuai dengan potensi serta passion kamu, dan kembangkan bersama.</p>
        </div>
    </div>
    
    <div class="join-us-section" data-aos="zoom-in" data-aos-delay="500">
    <div class="job-card">
        <div class="job-card-content">
            <h2>Posisi: Marketing Specialist</h2>
            <p><strong>Lokasi:</strong> Jakarta, Indonesia</p>
            <p class="job-description">
                Kami mencari Marketing Specialist yang berpengalaman untuk bergabung dengan tim kreatif kami. Tugas utama meliputi pengembangan strategi pemasaran, analisis pasar, dan peningkatan brand awareness.
            </p>
            <button class="apply-button">Lamar Sekarang</button>
        </div>
    </div>
</div>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection