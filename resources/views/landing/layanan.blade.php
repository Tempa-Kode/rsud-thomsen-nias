@extends('landing.template')
@section('title', 'Layanan')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/services.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/services_responsive.css') }}">
@endpush

@section('body')
    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="https://www.radargep.com/foto_berita/784531WhatsApp%20Image%202023-11-30%20at%2009.28.50.jpeg" data-speed="0.8"></div>
        <div class="home_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title">Pelayanan <span>RS Pratama Nias Barat</span></div>
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="#">Beranda</a></li>
                                    <li>Pelayanan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services -->

    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title"><h2>Jenis Pelayanan RS Pramata Nias Barat</h2></div>
                </div>
            </div>
            <div class="row services_row">
                <ol class="ml-5">
                    @foreach($pelayanan as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('landing/plugins/parallax-js-master/parallax.min.js') }}"></script>
    <script src="{{ asset('landing/js/services.js') }}"></script>
@endpush
