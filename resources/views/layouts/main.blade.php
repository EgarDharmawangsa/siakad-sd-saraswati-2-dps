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

    <div class="toast-container position-fixed start-50 translate-middle-x p-3" id="toast-container-js" style="top: 60px; z-index: 99999;">
        @if (session()->has('success'))
            <div class="toast align-items-center w-auto text-bg-success border-0 mb-2 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="max-width: none;">
                <div class="d-flex">
                    <div class="toast-body text-white text-nowrap">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="toast align-items-center w-auto text-bg-danger border-0 mb-2 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="max-width: none;">
                <div class="d-flex">
                    <div class="toast-body text-white text-nowrap">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('components.auth.log_out_modal')
    @include('components.delete_modal')
    @include('components.cancel_modal')
    @stack('scripts')
</body>

<script>


    window.showToast = function(message, type = 'success') {
        let container = document.getElementById('toast-container-js');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container-js';
            container.className = 'toast-container position-fixed top-0 start-50 translate-middle-x p-3'; 
            container.style.zIndex = '1055'; 
            document.body.appendChild(container);
        }

        let bgClass = 'text-bg-success'; 
        let icon = '<i class="bi bi-check-circle-fill me-2"></i>';

        if (type === 'error') {
            bgClass = 'text-bg-danger';
            icon = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
        } else if (type === 'info') {
            bgClass = 'text-bg-info';
            icon = '<i class="bi bi-info-circle-fill me-2"></i>';
        }

        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center w-auto ${bgClass} border-0 shadow-lg`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body text-white text-nowrap"> 
                    ${icon} ${message}
                </div>
            </div>
        `;

        container.appendChild(toastEl);

        if (typeof window.bootstrap !== 'undefined' && window.bootstrap.Toast) {
            const toast = new window.bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
            
            toastEl.addEventListener('hidden.bs.toast', () => {
                toastEl.remove();
            });
        }
    };
</script>

</html>
