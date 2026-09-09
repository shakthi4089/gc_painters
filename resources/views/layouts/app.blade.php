<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'GC Painting & Decorators') — Professional Painting Services</title>
  <meta name="description" content="Expert Residential, Apartment, Commercial & Industrial Painting Services across Chennai. 22+ Years Experience, Weather Guard Warranty & Dust-Free Work.">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom Design System CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : '1' }}">
</head>
<body>

  <!-- Top Info Bar -->
  <div class="bg-dark text-white py-2 fs-7">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-1 gap-md-4 px-2 px-md-3 text-center text-md-start">
      <div class="d-flex align-items-center justify-content-center gap-3 gap-md-4 text-nowrap flex-wrap">
        <a href="mailto:{{ config('custom-app.contact.email') }}" class="text-white text-decoration-none opacity-90"><i class="fa-solid fa-envelope text-warning me-1"></i>{{ config('custom-app.contact.email') }}</a>
        <a href="tel:{{ config('custom-app.contact.phone_raw') }}" class="text-white text-decoration-none opacity-90"><i class="fa-solid fa-phone text-warning me-1"></i>{{ config('custom-app.contact.phone_display') }}</a>
      </div>
      <div class="d-none d-md-flex align-items-center gap-3 text-nowrap">
        <span><i class="fa-solid fa-location-dot text-info me-1"></i> Serving {{ config('custom-app.contact.address') }}</span>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-0.5 ms-2">
          <i class="fa-solid fa-user-lock me-1"></i> Login
        </a>
      </div>
    </div>
  </div>

  <!-- Main Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom sticky-top navbar-dark py-2">
    <div class="container-fluid px-3 px-xl-4">
      <a class="navbar-brand d-flex align-items-center gap-2 text-nowrap" href="{{ route('home') }}">
        <span class="brand-badge py-1 px-2.5 fs-6"><i class="fa-solid fa-paint-roller me-1"></i>GC</span>
        <div>
          <div class="fw-black lh-1 text-white fs-6 text-nowrap">GC PAINTING</div>
          <small class="d-block fw-semibold text-info-emphasis opacity-90 text-nowrap" style="color: #93c5fd !important; font-size: 0.65rem; letter-spacing: 0.5px;">DECORATORS & CONTRACTORS</small>
        </div>
      </a>
      
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link py-1 px-2 text-nowrap dropdown-toggle {{ request()->routeIs('services*') ? 'active' : '' }}" href="{{ route('services') }}" data-bs-toggle="dropdown">Services</a>
            <ul class="dropdown-menu shadow border-0 rounded-3 mt-2">
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'residential-painting') }}"><i class="fa-solid fa-house text-primary me-2"></i>Residential Painting</a></li>
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'apartment-painting') }}"><i class="fa-solid fa-building text-info me-2"></i>Apartment Painting</a></li>
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'commercial-painting') }}"><i class="fa-solid fa-briefcase text-warning me-2"></i>Commercial Painting</a></li>
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'industrial-painting') }}"><i class="fa-solid fa-industry text-danger me-2"></i>Industrial Epoxy Coating</a></li>
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'interior-painting') }}"><i class="fa-solid fa-paint-roller text-success me-2"></i>Interior Finish & Texture</a></li>
              <li><a class="dropdown-item py-2 fw-medium" href="{{ route('services.detail', 'exterior-painting') }}"><i class="fa-solid fa-sun text-secondary me-2"></i>Exterior Weather Shield</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item py-2 fw-bold text-primary" href="{{ route('services') }}">View All Services &rarr;</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('projects*') ? 'active' : '' }}" href="{{ route('projects') }}">Our Projects</a></li>
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('before-after') ? 'active' : '' }}" href="{{ route('before-after') }}"><span class="badge bg-danger me-1">NEW</span>Before & After</a></li>
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
          <li class="nav-item"><a class="nav-link py-1 px-2 text-nowrap {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
          <li class="nav-item d-lg-none mt-2 pt-2 border-top border-secondary border-opacity-25">
            <a class="nav-link py-1 px-2 text-nowrap" href="{{ route('login') }}">
              <i class="fa-solid fa-user-lock me-1 text-info"></i> Login
            </a>
          </li>
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0 d-none d-lg-block">
            <a href="{{ route('quote') }}" class="btn btn-warning btn-sm rounded-pill px-3 py-1.5 fw-bold shadow-sm text-dark text-nowrap">
              <i class="fa-solid fa-calculator me-1"></i> Request Quote
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Flash Alerts -->
  @if(session('success'))
    <div class="container mt-3">
      <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm d-flex align-items-center justify-content-between" role="alert">
        <div>
          <i class="fa-solid fa-circle-check fs-5 me-2"></i>
          <strong>Success!</strong> {{ session('success') }}
        </div>
        @if(session('whatsapp_url'))
          <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-success btn-sm rounded-pill fw-bold ms-3">
            <i class="fa-brands fa-whatsapp me-1"></i> Continue on WhatsApp
          </a>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    </div>
  @endif

  <!-- Main Content Body -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer-custom text-white pt-5 mt-5 border-top border-secondary border-opacity-25">
    <div class="container pb-2">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="brand-badge"><i class="fa-solid fa-paint-roller me-2"></i>GC</span>
            <span class="fw-bold fs-4 text-white">GC PAINTING</span>
          </div>
          <p class="small mb-3">Over 22+ years of professional painting experience across Chennai. We deliver quality, damp-proof protection, dust-free execution, and 100% customer satisfaction.</p>
          <div class="d-flex gap-3 fs-5 mt-3">
            <a href="#" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" class="text-success fs-5"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-12 col-sm-6 mb-2 mb-lg-0">
          <h5 class="mb-3 fs-6 text-uppercase tracking-wider">Useful Links</h5>
          <ul class="list-unstyled small d-flex flex-column gap-2">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('services') }}">Our Services</a></li>
            <li><a href="{{ route('projects') }}">Completed Projects</a></li>
            <li><a href="{{ route('before-after') }}">Before & After</a></li>
            <li><a href="{{ route('quote') }}">Request a Quote</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-12 col-sm-6 mb-2 mb-lg-0">
          <h5 class="mb-3 fs-6 text-uppercase tracking-wider">Our Services</h5>
          <ul class="list-unstyled small d-flex flex-column gap-2">
            <li><a href="{{ route('services.detail', 'residential-painting') }}">Residential Painting</a></li>
            <li><a href="{{ route('services.detail', 'apartment-painting') }}">Apartment Elevation Coating</a></li>
            <li><a href="{{ route('services.detail', 'commercial-painting') }}">Commercial Office Painting</a></li>
            <li><a href="{{ route('services.detail', 'industrial-painting') }}">Industrial Epoxy Flooring</a></li>
            <li><a href="{{ route('services.detail', 'interior-painting') }}">Interior Wall Textures</a></li>
            <li><a href="{{ route('services.detail', 'exterior-painting') }}">Exterior Weather Proofing</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-12 mt-4 mt-lg-0">
          <h5 class="mb-3 fs-6 text-uppercase tracking-wider">Contact Us</h5>
          <ul class="list-unstyled small d-flex flex-column gap-3">
            <li class="d-flex gap-2"><i class="fa-solid fa-location-dot text-warning mt-1"></i> <span>{{ config('custom-app.contact.address') }}</span></li>
            <li class="d-flex gap-2"><i class="fa-solid fa-phone text-warning mt-1"></i> <span>{{ config('custom-app.contact.phone_display') }}</span></li>
            <li class="d-flex gap-2"><i class="fa-solid fa-envelope text-warning mt-1"></i> <span>{{ config('custom-app.contact.email') }}</span></li>
          </ul>
        </div>
      </div>

      <hr class="border-secondary border-opacity-25 my-4">

      <div class="text-center small opacity-90 mb-2">
        Working Areas: {{ config('custom-app.contact.working_areas') }}
      </div>
    </div>

    <!-- Green Full-Width Copyright Strip -->
    <div class="footer-copyright-bar py-2.5 text-center text-white small fw-medium mt-3">
      <div class="container">
        Copyrights &copy; GC Painting & Decorators
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp CTA (Left Side) -->
  <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" target="_blank" class="floating-whatsapp-btn" title="Chat on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>



  <!-- Scroll To Top Button with Circular Progress Ring -->
  <div id="scrollTopProgress" class="scroll-top-progress" aria-label="Scroll to top">
    <svg class="progress-ring" width="48" height="48" viewBox="0 0 48 48">
      <circle class="progress-ring__circle-bg" stroke="#e0e7ff" stroke-width="3" fill="#ffffff" r="19" cx="24" cy="24"/>
      <circle class="progress-ring__circle" stroke="#10b981" stroke-width="3" stroke-dasharray="119.38" stroke-dashoffset="119.38" stroke-linecap="round" fill="transparent" r="19" cx="24" cy="24"/>
    </svg>
    <i class="fa-solid fa-chevron-up scroll-top-icon"></i>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
