<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD RASDA | {{ $judul }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column vh-100 p-0 m-0">
  @include('partials.navbar')

  <div class="d-flex flex-grow-1">
    @include('partials.sidebar')

    <div class="container-fluid content-container">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <h2 class="mt-2 mb-4">{{ $judul }}</h2>

      @yield('container')
    </div>
  </div>
  
  @vite('resources/js/app.js')
</body>

</html>