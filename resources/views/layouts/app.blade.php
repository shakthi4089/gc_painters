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
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <!-- Top Info Bar -->
  <div class="bg-dark text-white py-1 border-bottom border-secondary border-opacity-25 fs-7">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <div class="d-flex align-items-center gap-4">
        <span><i class="fa-solid fa-phone text-warning me-2"></i> +91 89250 14875</span>
        <span class="d-none d-md-inline"><i class="fa-solid fa-location-dot text-info me-2"></i> Serving Chennai, Avadi, Ambattur & Surrounding Areas</span>
      </div>
      <div class="d-flex align-items-center gap-3">
        <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" target="_blank" class="text-success text-decoration-none fw-semibold">
          <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp Us
        </a>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 ms-2">
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
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
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
  <footer class="bg-dark text-white pt-5 pb-4 mt-5 border-top border-secondary border-opacity-25">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="brand-badge"><i class="fa-solid fa-paint-roller me-2"></i>GC</span>
            <span class="fw-bold fs-4">GC PAINTING</span>
          </div>
          <p class="text-secondary small">Over 22+ years of professional painting experience across Chennai. We deliver quality, damp-proof protection, dust-free execution, and 100% customer satisfaction.</p>
          <div class="d-flex gap-3 text-secondary fs-5 mt-3">
            <a href="#" class="text-secondary hover-primary"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="text-secondary hover-primary"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" class="text-success"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <h5 class="text-white mb-3 fs-6 fw-bold text-uppercase tracking-wider">Quick Links</h5>
          <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
            <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none">Home</a></li>
            <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none">About Us</a></li>
            <li><a href="{{ route('services') }}" class="text-secondary text-decoration-none">Our Services</a></li>
            <li><a href="{{ route('projects') }}" class="text-secondary text-decoration-none">Completed Projects</a></li>
            <li><a href="{{ route('before-after') }}" class="text-secondary text-decoration-none">Before & After</a></li>
            <li><a href="{{ route('quote') }}" class="text-secondary text-decoration-none">Request a Quote</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-6">
          <h5 class="text-white mb-3 fs-6 fw-bold text-uppercase tracking-wider">Services</h5>
          <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
            <li><a href="{{ route('services.detail', 'residential-painting') }}" class="text-secondary text-decoration-none">Residential Painting</a></li>
            <li><a href="{{ route('services.detail', 'apartment-painting') }}" class="text-secondary text-decoration-none">Apartment Elevation Coating</a></li>
            <li><a href="{{ route('services.detail', 'commercial-painting') }}" class="text-secondary text-decoration-none">Commercial Office Painting</a></li>
            <li><a href="{{ route('services.detail', 'industrial-painting') }}" class="text-secondary text-decoration-none">Industrial Epoxy Flooring</a></li>
            <li><a href="{{ route('services.detail', 'interior-painting') }}" class="text-secondary text-decoration-none">Interior Wall Textures</a></li>
            <li><a href="{{ route('services.detail', 'exterior-painting') }}" class="text-secondary text-decoration-none">Exterior Weather Proofing</a></li>
          </ul>
        </div>

        <div class="col-lg-3">
          <h5 class="text-white mb-3 fs-6 fw-bold text-uppercase tracking-wider">Contact Us</h5>
          <ul class="list-unstyled small d-flex flex-column gap-3 text-secondary">
            <li class="d-flex gap-2"><i class="fa-solid fa-user text-warning mt-1"></i> <span><strong>Proprietor:</strong> G. Chandran</span></li>
            <li class="d-flex gap-2"><i class="fa-solid fa-phone text-warning mt-1"></i> <span>+91 89250 14875</span></li>
            <li class="d-flex gap-2"><i class="fa-solid fa-envelope text-warning mt-1"></i> <span>contact@gcpainting.com</span></li>
            <li class="d-flex gap-2"><i class="fa-solid fa-location-dot text-warning mt-1"></i> <span>Anna Nagar & Avadi, Chennai, Tamil Nadu</span></li>
          </ul>
        </div>
      </div>

      <hr class="border-secondary border-opacity-25 my-4">

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
        <div>&copy; {{ date('Y') }} GC Painting & Decorators. All rights reserved.</div>
        <div class="mt-2 mt-md-0">Working Areas: Chennai | Avadi | Ambattur | Velachery | Porur | Tambaram</div>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp CTA -->
  <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" target="_blank" class="floating-whatsapp-btn" title="Chat on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <!-- Mobile Sticky Bar -->
  <div class="sticky-contact-bar d-md-none">
    <a href="tel:+918925014875" class="btn btn-primary flex-fill fw-bold rounded-pill">
      <i class="fa-solid fa-phone me-1"></i> Call Now
    </a>
    <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" target="_blank" class="btn btn-success flex-fill fw-bold rounded-pill">
      <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
    </a>
    <a href="{{ route('quote') }}" class="btn btn-warning flex-fill fw-bold rounded-pill text-dark">
      <i class="fa-solid fa-calculator me-1"></i> Quote
    </a>
  </div>

  <!-- Scripts -->
  <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
