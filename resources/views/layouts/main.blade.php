<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/saraswati_logo.png') }}">
    <title>SIAKAD RASDA | {{ $judul }}</title>
    @vite('resources/js/app.js')
</head>

<body id="page-body" class="d-flex flex-column vh-100 p-0 m-0" data-route-name="{{ Route::currentRouteName() }}">

    @include('partials.navbar')

    <div class="d-flex flex-grow-1">
        @include('partials.sidebar')

        <div class="container-fluid content-container d-flex flex-column">

            <h3 class="mt-1 mb-3">{{ $judul }}</h3>

            @yield('container')

            <footer class="mt-auto">
                <p class="text-muted text-center mb-0 login-copyright-label">&copy; 2025 SIAKAD RASDA. All rights
                    reserved.</p>
            </footer>
        </div>
    </div>

    <div class="toast-container position-fixed start-50 translate-middle-x p-3" style="top: 60px; z-index: 99999;">

        @if (session()->has('success'))
            <div class="toast show align-items-center w-auto text-bg-success border-0 mb-2 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="max-width: none;">
                <div class="d-flex">
                    <div class="toast-body text-white text-nowrap">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="toast show align-items-center w-auto text-bg-danger border-0 mb-2 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="max-width: none;">
                <div class="d-flex">
                    <div class="toast-body text-white text-nowrap">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- @if ($errors->any())
        <div class="toast show align-items-center w-auto text-bg-danger border-0 mb-2 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" style="max-width: none;">
            <div class="d-flex">
                <div class="toast-body text-white"> 
                    <strong><i class="bi bi-x-circle-fill me-2"></i> Periksa Inputan:</strong>
                    <span class="ms-1">{{ $errors->first() }}</span> 
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif --}}

    </div>

    @include('components.auth.log_out_modal')
    @include('components.delete_modal')
    @include('components.cancel_modal')
    @stack('scripts')
</body>

</html>
