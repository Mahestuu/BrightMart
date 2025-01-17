@extends('utama.app')
@section('content')
    
    <section class="location">
        <h2>Lokasi Toko Kami</h2>
        <div class="container">
            <table class="store-table">
                <thead>
                    <tr>
                        <th>NAMA TOKO</th>
                        <th>LOKASI</th>
                        <th>PETA</th>
                        <th>ALAMAT</th>
                        <th>TELEPON</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cabang 1 -->
                    <tr>
                        <td>Toko Surabaya</td>
                        <td>Surabaya</td>
                        <td>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.1234567890123!2d112.123456789!3d-7.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788dabcdefg!2sBrightMart!5e0!3m2!1sen!2sid!4v1621234567890" 
                                    width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </td>
                        <td>Jalan Ir. Soekarno No.123, Surabaya, Indonesia</td>
                        <td>(031) 123-4567</td>
                    </tr>
                    <!-- Cabang 2 -->
                    <tr>
                        <td>Toko Malang</td>
                        <td>Malang</td>
                        <td>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.1234567890123!2d112.123456789!3d-7.456789012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788dabcdefg!2sBrightMart!5e0!3m2!1sen!2sid!4v1621234567890" 
                                    width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </td>
                        <td>Jalan A. Yani No.45, Malang, Indonesia</td>
                        <td>(0341) 987-6543</td>
                    </tr>
                    <!-- Cabang 3 -->
                    <tr>
                        <td>Toko Surabaya 2</td>
                        <td>Surabaya</td>
                        <td>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.1234567890123!2d112.123456789!3d-7.789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788dabcdefg!2sBrightMart!5e0!3m2!1sen!2sid!4v1621234567890" 
                                    width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </td>
                        <td>Jalan Ahmad Yani No.67, Surabaya, Indonesia</td>
                        <td>(031) 765-4321</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>


@endsection

