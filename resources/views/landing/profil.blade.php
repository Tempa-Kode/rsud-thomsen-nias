@extends('landing.template')
@section('title', 'Profil')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/about.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/about_responsive.css') }}">
    <style>
        .about_text p {
            text-align: justify;
            text-indent: 30px;
        }
    </style>
@endpush

@section('body')
    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="https://www.radargep.com/foto_berita/784531WhatsApp%20Image%202023-11-30%20at%2009.28.50.jpeg" data-speed="0.8"></div>
        <div class="home_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title">Profil <span>RS Pratama Nias Barat</span></div>
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="#">Beranda</a></li>
                                    <li>Profil</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About -->
    <div class="about">
        <div class="container">
            <div class="row">

                <!-- About Content -->
                <div class="col-lg-8">
                    <div class="section_title"><h2>Sejarah RS Pratama Nias Barat</h2></div>
                    <div class="about_text">
                        <p>Pada Tahun 2013 diadakan tahap awal perencanaan pembangunan rumah sakit kelas D Pratama oleh pemerintah Kabupaten Nias Barat.Setelah proses pembangunan gedung Rumah Sakit Pratama Nias Barat selesai,maka pada tanggal 01 Desember 2020 Rumah Sakit Pratama Nias Barat secara resmi beroperasi dan memberikan pelayanan kepada masyarakat..</p>
                        <p>Tujuan utama pembangunan Rumah Sakit Pratama Nias Barat untuk meningkatkan pelayanan kesehatan khususnya pelayanan rujukan di wilayah  terpencil itu berdasarkan Peraturan Presiden No.131 Tahun 2015 tentang penetapan Daerah Tertinggal 2015-2019 dan Permenkes No.24 Tahun 2014 tentang Rumah sakit kelas D Pratama</p>
                        <p>Rumah Sakit Pratama Nias Barat adalah rumah sakit milik pemerintah Daerah Kabupaten Nias Barat yang ditetapkan sebagai rumah sakit kelas D Pratama berdasarkan Peraturan Bupati No.52 Tahun 2018</p>
                        <p>Rumah Sakit Umum Daerah Gunungsitoli merupakan salah satu fasilitas kesehatan rujukan tingkat lanjutan sekaligus sebagai Rumah Sakit Rujukan Regional di Kepulauan Nias sesuai dengan Keputusan Direktur Jenderal Pelayanan Kesehatan Nomor HK.02.03/1/0363/2015 tentang Penetapan Rumah Sakit Rujukan Provinsi dan Rumah Sakit Rujukan Regional dan Peraturan Gubernur Sumatera Utara Nomor 25 tahun 2016 tentang perubahan atas Peraturan Gubernur Sumatera Utara Nomor 35 Tahun 2014 tentang Pedoman Pelaksanaan Sistem Rujukan Pelayanan Kesehatan di Provinsi Sumatera Utara.</p>
                        <p>Sebagai Rumah Sakit Rujukan Regional maka RSUD Gunungsitoli terus berbenah untuk dapat mewujudkan visi menjadi Rumah Sakit Kelas B dan Rumah Sakit Pendidikan sesuai standar dan ketentuan yang berlaku. Pada tahun 2017 telah dilaksanakan bimbingan akreditasi, survey simulasi dan survey akreditasi dari Tim KARS dengan hasil RSUD Gunungsitoli terakreditasi VERSI 2012 TINGKAT PARIPURNA</p>
                        <p>Sejak 1 Januari 2015, RSUD Gunungsitoli telah menerapkan fleksibilitas pada Pola Pengelolaan Keuangan (PPK) BLUD dengan spirit BLUD yaitu Praktek Bisnis Yang Sehat untuk meningkatkan kinerja manfaat, kinerja keuangan dan kinerja pelayanan</p>
                        <p>RSUD Gunungsitoli sebagai Badan Layanan Umum Daerah (BLUD) dengan status BLUD Penuh sesuai dengan Keputusan Bupati Nias Nomor 445/336/K/2014 tentang Penetapan Status Pola Pengelolaan Keuangan Badan Layanan Umum Daerah (PPK-BLUD) Pada Rumah Sakit Umum Daerah Gunungsitoli Kabupaten Nias</p>
                        <p>RSUD Gunungsitoli pada prinsipnya selalu mengedepankan pelayanan kepada pasien yang optimal (orientasi pelayanan kepada pasien) sehingga pasien yang berkunjung di RSUD Gunungsitoli dapat terlayani dengan baik dan meningkatkan jumlah kunjungan pasien guna menunjang pembangunan melalui pendapatan rumah sakit yang terus meningkat.Kini Pemerintah Kabupaten Nias akan mengubah nama Rumah Sakit Umum Daerah (RSUD) Gunungsitoli menjadi RSUD dr MG Thomsen Nias.</p>
                    </div>
                </div>

                <!-- Boxes -->
                <div class="col-lg-4 boxes_col">

                    <!-- Box -->
                    <div class="box working_hours">
                        <div class="box_icon d-flex flex-column align-items-start justify-content-center"><div style="width:29px; height:29px;"><img src="{{ asset('landing/images/alarm-clock.svg') }}" alt=""></div></div>
                        <div class="box_title">Jam Pelayanan</div>
                        <div class="working_hours_list">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Senin – Jumat</div>
                                    <div class="ml-auto">8.00 – 19.00</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Sabtu</div>
                                    <div class="ml-auto">9.30 – 17.00</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Minggu</div>
                                    <div class="ml-auto">9.30 – 15.00</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Box -->
                    <div class="box box_emergency">
                        <div class="box_icon d-flex flex-column align-items-start justify-content-center"><div style="width: 37px; height:37px; margin-left:-4px;"><img src="{{ asset('landing/images/bell.svg') }}" alt=""></div></div>
                        <div class="box_title">Gawat Darurat 24 Jam</div>
                        <div class="box_phone">0822-2564-9298</div>
                        <div class="box_emergency_text">siap memberikan penanganan medis cepat dan tepat untuk kondisi darurat Anda.</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->

    <div class="testimonials">
        <div class="testimonials_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('landing/images/testimonials.jpg') }}" data-speed="0.8"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title section_title_light"><h2>Visi & Misi</h2></div>
                </div>
            </div>
            <div class="row test_row">

                <!-- Testimonial -->
                <div class="col-lg-6 test_col">
                    <div class="testimonial">
                        <div class="test_icon d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('landing/images/quote.png') }}" alt=""></div>
                        <h2 class="text-white">Visi</h2>
                        <div class="test_text">Terwujudnya masyarakat  Nias Barat  yang  sehat,mandiri dan unggul dalam meningkatkan derajat kesehatan.</div>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="col-lg-6 test_col">
                    <div class="testimonial">
                        <div class="test_icon d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('landing/images/quote.png') }}" alt=""></div>
                        <h2 class="text-white">Misi</h2>
                        <div class="test_text">
                            <ol>
                                <li>Menyelenggarakan pelayanan kesehatan yang bermutu dan terjangkau.</li>
                                <li>Menyelenggarakan pengolahan sumber daya rumah sakit secara profesional.</li>
                                <li>Menyelenggarakan peningkatan ilmu dan keterampilan tenaga kesehatan serta peningkatan fasilitas kesehatan</li>
                                <li>Mengembangkan  inovasi dalam  rangka meningkatkan  kualitas pelayanan kesehatan pada masyarakat</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Team -->

    <div class="team">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title"><h2>Struktur Organisasi</h2></div>
                </div>
            </div>
            <div class="row team_row">
                <img src="{{ asset('landing/images/struktur-organisasi.jpg') }}" alt="struktur organisasi" style="width: 100%;">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('landing/plugins/greensock/TweenMax.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/greensock/TimelineMax.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/greensock/animation.gsap.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/progressbar/progressbar.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('landing/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('landing/plugins/parallax-js-master/parallax.min.js') }}"></script>
    <script src="{{ asset('landing/js/about.js') }}"></script>
@endpush
