@extends('layouts.error_main')

@section('container')
    <div class="error-content-card m-4">
        <h1 class="error-code">500.</h1>
        <h4>Terjadi Kesalahan</h4>
        <p class="mb-3">Maaf, terjadi kesalahan pada sistem ini.</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary mt-2 error-button">Kembali</a>
    </div>
@endsection
