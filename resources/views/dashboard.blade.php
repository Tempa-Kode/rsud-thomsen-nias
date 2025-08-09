@extends('template')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('body')
    <div class="col-12 mb-4">
        <div class="hero bg-primary text-white">
            <div class="hero-inner">
                <h2>Selamat Datang, {{ Auth::user()->username }}!</h2>
                <p class="lead">Anda hampir selesai, lengkapi informasi akun Anda untuk menyelesaikan pendaftaran.</p>
                <div class="mt-4">
                    <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Lengkapi Akun</a>
                </div>
            </div>
        </div>
    </div>
@endsection
