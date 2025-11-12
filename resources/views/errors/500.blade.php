@extends('errors.error_main')

@section('container')
    <div class="error-content-card m-4 p-4">
        <h1 class="error-code">500.</h1>
        <h4>Terjadi Kesalahan</h4>
        <p class="mb-4">Maaf, terjadi kesalahan pada sistem.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary mt-2 error-button">Kembali ke Beranda</a>
    </div>
@endsection
