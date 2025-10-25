<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD RASDA | {{ $judul }}</title>
    @vite('resources/js/app.js')
</head>

<body class="d-flex align-items-center justify-content-center vh-100 m-0 login-body">
    <div class="toast-container position-fixed start-50 translate-middle-x">
        @if (session()->has('success'))
            <div class="toast align-items-center border-0" id="success-toast" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="toast align-items-center text-bg-danger border-0" id="error-toast" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="close"></button>
                </div>
            </div>
        @endif
    </div>

    <div class="content-card login-form-card p-4">
        {{-- <img src="{{ asset('images/saraswati_logo.png') }}" alt="Logo" class="logo position-absolute z-1 top-0"> --}}
        <h5 class="text-center mb-3">Sistem Informasi Akademik SD Saraswati 2 Denpasar</h5>
        <p class="text-center">Silahkan Masuk</p>
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username') }}" required autofocus autocomplete="username"
                    placeholder="Masukkan username">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn w-100 login-button">Masuk</button>
        </form>
    </div>
</body>

</html>
