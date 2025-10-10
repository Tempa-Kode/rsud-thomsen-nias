@extends('landing.template')
@section('title', 'Beranda')

@section('body')
    <!-- Home -->
    <div class="home">
        <div class="home_slider_container">
            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">

                <!-- Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url(https://kemkes.go.id/app_asset/image_content/17522907386871d5b2baad57.41080010.jpg); opacity: 0.33"></div>
                    <div class="home_content">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content_inner">
                                        <div class="home_title"><h1>RS Pratama Nias Barat</h1></div>
                                        <div class="home_text">
                                            <p>Memberikan layanan kesehatan terbaik dengan teknologi medis terdepan dan tim dokter berpengalaman. Kami berkomitmen untuk menjadi mitra terpercaya dalam menjaga kesehatan Anda dan keluarga dengan pelayanan yang ramah, profesional, dan terjangkau.</p>
                                        </div>
                                        <div class="button home_button">
                                            <a href="{{ route('dashboard') }}">Daftar Rawat Jalan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url(https://detik86.com/wp-content/uploads/2021/02/6629e1faa0532-678x381.jpg); opacity: 0.33"></div>
                    <div class="home_content">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content_inner">
                                        <div class="home_title"><h1>RS Pratama Nias Barat</h1></div>
                                        <div class="home_text">
                                            <p>Memberikan layanan kesehatan terbaik dengan teknologi medis terdepan dan tim dokter berpengalaman. Kami berkomitmen untuk menjadi mitra terpercaya dalam menjaga kesehatan Anda dan keluarga dengan pelayanan yang ramah, profesional, dan terjangkau.</p>
                                        </div>
                                        <div class="button home_button">
                                            <a href="{{ route('dashboard') }}">Daftar Rawat Jalan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url(https://asset-2.tribunnews.com/medan/foto/bank/images/Pembangunan-RS-Nias-Barat.jpg); opacity: 0.33"></div>
                    <div class="home_content">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content_inner">
                                        <div class="home_title"><h1>RS Pratama Nias Barat</h1></div>
                                        <div class="home_text">
                                            <p>Memberikan layanan kesehatan terbaik dengan teknologi medis terdepan dan tim dokter berpengalaman. Kami berkomitmen untuk menjadi mitra terpercaya dalam menjaga kesehatan Anda dan keluarga dengan pelayanan yang ramah, profesional, dan terjangkau.</p>
                                        </div>
                                        <div class="button home_button">
                                            <a href="{{ route('dashboard') }}">Daftar Rawat Jalan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Slider Progress -->
            <div class="home_slider_progress"></div>
        </div>
    </div>

    <!-- Departments -->

    <div class="departments">
        <div class="departments_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('landing/images/departments.jpg') }}" data-speed="0.8"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title section_title_light"><h2>Jenis Pelayanan</h2></div>
                </div>
            </div>
            <div class="row departments_row row-md-eq-height">

                <!-- Department -->
                @foreach($layanan as $item)
                    <div class="col-lg-3 col-md-6 dept_col">
                        <div class="dept">
                            <div class="dept_image"><img src="{{ asset($item['background_image']) }}" alt=""></div>
                            <div class="dept_content text-center">
                                <div class="dept_title">{{ $item['layanan'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Department -->
                <div class="col-lg-3 col-md-6 dept_col">
                    <div class="dept">
                        <div class="dept_text">
                            <p>Kami menyediakan berbagai layanan kesehatan komprehensif dengan standar medis internasional. Tim medis berpengalaman siap memberikan pelayanan terbaik untuk memenuhi kebutuhan kesehatan Anda dan keluarga.</p>
                        </div>
                        <div class="button dept_button"><a href="{{ route('layanan') }}">Lihat Selengkapnya</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
