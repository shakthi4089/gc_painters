<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'My Project Portal') — GC Painting</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark sticky-top py-3 border-bottom border-secondary border-opacity-25">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <span class="brand-badge"><i class="fa-solid fa-paint-roller me-1"></i>GC</span>
        <span class="fw-bold text-white fs-5">CUSTOMER PORTAL</span>
      </a>

      <div class="d-flex align-items-center gap-3">
        <span class="text-light small d-none d-md-inline">Welcome, <strong>{{ Auth::check() ? Auth::user()->name : 'Ramesh Kumar' }}</strong></span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
