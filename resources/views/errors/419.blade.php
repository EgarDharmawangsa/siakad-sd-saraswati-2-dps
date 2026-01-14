@extends('layouts.error_main')

@section('container')
    <div class="error-content-card m-4">
        <h1 class="error-code">419.</h1>
        <h4>Halaman Kadaluwarsa</h4>
        <p class="mb-3">Maaf, halaman yang anda cari telah kadaluwarsa.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary mt-2 error-button">Kembali</a>
    </div>
@endsection
