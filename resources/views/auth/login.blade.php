<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD RASDA | {{ $judul }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --brand: #27ae60;
      --brand-dark: #1e8f4d;
      --brand-light: #e8f5e9;
      --card-radius: 16px;
    }

    html, body {
      height: 100%;
    }

    body.login-body {
      background: linear-gradient(135deg, #f6f7fb 0%, #eef2ff 100%);
      margin: 0;
      font-family: 'Segoe UI', system-ui, -apple-system, Roboto, Ubuntu, sans-serif;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-wrap {
      width: 100%;
      max-width: 900px;
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 15px 40px rgba(13, 38, 76, 0.12);
      overflow: hidden;
      display: flex;
      flex-direction: row;
    }

    .login-left {
      padding: 50px;
      flex: 1;
    }

    .brand-title {
      font-weight: 800;
      font-size: 28px;
      margin: 0 0 10px 0;
      color: #1a1a1a;
    }

    .brand-sub {
      margin: 0 0 32px 0;
      color: #6b7280;
      font-size: 16px;
    }

    .form-label {
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }

    .form-control {
      padding: 0.85rem 1rem;
      border-radius: 12px;
      border: 1px solid #d1d5db;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--brand);
      box-shadow: 0 0 0 0.25rem rgba(39, 174, 96, 0.15);
    }

    .input-group .btn-outline-secondary {
      border-color: #d1d5db;
      border-radius: 0 12px 12px 0;
    }

    .login-button {
      background: var(--brand);
      color: #fff;
      border: none;
      padding: 0.9rem 1rem;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .login-button:hover {
      background: var(--brand-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(39, 174, 96, 0.3);
    }

    .helper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: -8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .form-check-input:checked {
      background-color: var(--brand);
      border-color: var(--brand);
    }

    .login-right {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      background: linear-gradient(135deg, var(--brand-light) 0%, #e3f2fd 100%);
      position: relative;
      overflow: hidden;
    }

    .login-illustration {
      width: 100%;
      max-width: 420px;
      border-radius: 16px;
      aspect-ratio: 4/3;
      background: linear-gradient(135deg, #e8f5e9 0%, #e3f2fd 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: var(--brand);
      border: 2px dashed #b2dfdb;
      padding: 20px;
      text-align: center;
    }

    .illustration-icon {
      font-size: 80px;
      margin-bottom: 20px;
    }

    .illustration-text {
      font-size: 18px;
      font-weight: 600;
      color: var(--brand-dark);
    }

    .toast-container {
      top: 24px;
      z-index: 1055;
    }

    #success-toast,
    #error-toast {
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    #success-toast {
      background: var(--brand);
    }

    #error-toast {
      background: #dc3545;
    }

    @media (max-width: 992px) {
      .login-wrap {
        flex-direction: column;
      }
      
      .login-left {
        padding: 30px;
      }
      
      .login-right {
        display: none;
      }
    }

    @media (max-width: 576px) {
      .login-left {
        padding: 20px;
      }
      
      .helper {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>

<body class="login-body">
  <div class="login-container">
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x mt-3">
      @if (session()->has('success'))
        <div class="toast align-items-center border-0 text-white" id="success-toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="close"></button>
          </div>
        </div>
      @endif

      @if (session()->has('error'))
        <div class="toast align-items-center border-0 text-white" id="error-toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="close"></button>
          </div>
        </div>
      @endif
    </div>

    <div class="login-wrap">
      <div class="login-left">
        <div class="text-center mb-4">
          <h1 class="brand-title">Selamat Datang</h1>
          <p class="brand-sub">Sistem Informasi Akademik SD Saraswati 2 Denpasar</p>
        </div>

        <!-- Form langsung tanpa card tambahan -->
        <form action="{{ route('authenticate') }}" method="POST" novalidate>
          @csrf

          <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-user text-muted"></i>
              </span>
              <input
                type="text"
                class="form-control @error('username') is-invalid @enderror border-start-0"
                id="username"
                name="username"
                value="{{ old('username') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan username">
            </div>
            @error('username')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-lock text-muted"></i>
              </span>
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror border-start-0"
                id="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password">
              <button class="btn btn-outline-secondary" type="button" id="togglePass">
                <i class="fas fa-eye" id="eye-icon"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          {{-- <div class="helper">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa kata sandi?</a>
          </div> --}}

          <button type="submit" class="btn w-100 login-button">
            <i class="fas fa-sign-in-alt me-2"></i>Masuk
          </button>
        </form>

        <div class="text-center mt-4">
          <p class="text-muted small">&copy; 2023 SIAKAD RASDA. All rights reserved.</p>
        </div>
      </div>

      <div class="login-right">
        <div class="login-illustration">
          <i class="fas fa-graduation-cap illustration-icon"></i>
          <div class="illustration-text">Sistem Informasi Akademik</div>
          <p class="text-muted mt-2">SD Saraswati 2 Denpasar</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Toast notifications
    document.querySelectorAll('.toast').forEach(function(el) {
      try {
        var t = new bootstrap.Toast(el, { delay: 5000 });
        t.show();
      } catch (e) {
        console.error(e);
      }
    });

    // Toggle password visibility
    const pass = document.getElementById('password');
    const btn = document.getElementById('togglePass');
    const eyeIcon = document.getElementById('eye-icon');
    
    if (btn && pass && eyeIcon) {
      btn.addEventListener('click', function() {
        const isHidden = pass.type === 'password';
        pass.type = isHidden ? 'text' : 'password';
        eyeIcon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
        btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');
      });
    }
  </script>
</body>
</html>