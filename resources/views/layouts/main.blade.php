<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD RASDA | {{ $judul }}</title>
    @vite('resources/js/app.js')
</head>

<body class="d-flex flex-column vh-100 p-0 m-0">
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
        
        {{-- @if (session()->has('error'))
            <div class="toast align-items-center text-bg-danger border-0 w-auto" id="error-toast" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body text-white">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="close"></button>
                </div>
            </div>
        @endif --}}
    </div>
    
    @include('partials.navbar')

    <div class="d-flex flex-grow-1">
        @include('partials.sidebar')

        <div class="container-fluid content-container">

            <h3 class="mt-2 mb-4">{{ $judul }}</h3>

            @yield('container')
        </div>
    </div>

    @include('components.delete_modal')
    @include('components.cancel_modal')
</body>

</html>
