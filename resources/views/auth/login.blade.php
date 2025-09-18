<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Login - Selamat Datang</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/pages/auth/login.css') }}">
</head>
<body>
<div class="container-full">
    <div class="left-side">
        <div class="login-box">
            <h1>Selamat Datang</h1>
            <p>Selamat datang, silahkan masukan data anda</p>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->has('login'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ $errors->first('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <input type="text"
                       class="form-control @error('username') is-invalid @enderror"
                       id="username"
                       name="username"
                       placeholder="Username"
                       value="{{ old('username') }}"
                       required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="password-wrap">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Password"
                           required>
                    <button type="button" class="password-toggle" id="togglePassBtn">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-login">Masuk</button>
            </form>
        </div>
    </div>
    <div class="right-side"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/pages/auth/login.js') }}">
</script>
</body>
</html>
