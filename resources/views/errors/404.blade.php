@extends('layouts.error_main')

@section('container')
    <div class="error-content-card m-4 p-4">
        <h1 class="error-code">404.</h1>
        <h4>Halaman Tidak Ditemukan</h4>
        <p class="mb-4">Maaf, halaman yang Anda cari tidak tersedia pada sistem ini.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary mt-2 error-button">Kembali ke Beranda</a>
    </div>
@endsection
