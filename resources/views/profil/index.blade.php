@php
    $role = Auth::user()->role;
    $relationName = $role; // 'pimpinan', 'dokter', 'kasir', or 'pasien'
    $relationData = $data->$relationName; // Access the dynamically loaded relationship
@endphp

@extends('template')

@section('title', 'Profil')

@section('header', 'Profil')

@section('body')
    <div class="section-body">
        <h2 class="section-title">Hi, {{ Auth::user()->username }}!</h2>
        <p class="section-lead">
            Ubah informasi tentang diri Anda di halaman ini.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{ $relationData->nama ?? 'Nama Belum Diisi' }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ Auth::user()->username }}</div></div>
                        {{ $relasiData->alamat ?? '-' }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    @switch(\Illuminate\Support\Facades\Auth::user()->role)
                        @case('pasien')
                            @include('komponen.profile.pasien')
                            @break
                        @case('pimpinan')
                            @include('komponen.profile.pimpinan')
                            @break
                        @case('kasir')
                            @include('komponen.profile.kasir')
                            @break
                        @case('dokter')
                            @include('komponen.profile.dokter')
                            @break
                        @default
                            -
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection
