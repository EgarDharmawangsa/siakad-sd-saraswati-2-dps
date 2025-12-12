@extends('layouts.error_main')

@section('container')
    <div class="error-content-card m-4">
        <h1 class="error-code">403.</h1>
        <h4>Akses Ditolak</h4>
        <p class="mb-3">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary mt-2 error-button">Kembali ke Beranda</a>
    </div>
@endsection
