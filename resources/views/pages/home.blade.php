@extends('layouts.app')

@section('title', 'GC Painting & Decorators — Home')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <div class="hero-tag">
          <i class="fa-solid fa-shield-halved text-warning"></i>
          <span>Over 22+ Years of Trusted Craftsmanship in Chennai</span>
        </div>
        <h1 class="hero-title">
          Transforming Homes, Apartments & Buildings With Quality & Care
        </h1>
        <p class="lead text-light opacity-75 mb-4">
          Professional residential, apartment, commercial, and epoxy floor painting. From crack-proof damp sealers to luxury metallic wall textures — we manage your project end-to-end.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-4">
          <a href="{{ route('quote') }}" class="btn btn-warning btn-sm rounded-pill px-3 py-2 fw-bold shadow-sm text-dark">
            <i class="fa-solid fa-calculator me-1"></i> Request Quote
          </a>
          <a href="{{ route('projects') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold">
            <i class="fa-solid fa-images me-1"></i> View Projects
          </a>
          <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}&type=phone_number&app_absent=0" target="_blank" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-semibold">
            <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
          </a>
        </div>

        <div class="d-flex align-items-center gap-4 text-white-50 pt-3 border-top border-secondary border-opacity-25">
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-check text-success fs-5"></i>
            <span class="small">5-Year Weather Guarantee</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-check text-success fs-5"></i>
            <span class="small">Dust-Free Sanding</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-check text-success fs-5"></i>
            <span class="small">Asian Paints & Dulux</span>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <!-- Interactive Featured Before/After Hero Showcase -->
        <div class="bg-dark p-3 rounded-4 border border-secondary border-opacity-25 shadow-lg">
          <div class="d-flex justify-content-end align-items-center mb-2 px-2">
            <small class="text-white-50">Apartment Elevation Project</small>
          </div>
          <div class="ba-container">
            <img src="{{ asset('images/project1_after.svg') }}" class="ba-image-after" alt="After Elevation Painting">
            <div class="ba-image-before-wrapper">
              <img src="{{ asset('images/project1_before.svg') }}" class="ba-image-before" alt="Before Painting Damage">
            </div>
            <div class="ba-handle"><i class="fa-solid fa-arrows-left-right"></i></div>
            <span class="ba-label-before">BEFORE</span>
            <span class="ba-label-after">AFTER</span>
          </div>
          <div class="text-center text-white-50 small mt-2">
            <i class="fa-solid fa-location-dot text-danger me-1"></i> Anna Nagar, Chennai &bull; 25,000 sq.ft
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Live Key Business Stats -->
<section class="py-4 bg-white border-bottom shadow-sm">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-6 col-md-3">
        <div class="display-5 fw-extrabold text-primary">{{ $stats['experience'] }}</div>
        <div class="text-secondary fw-semibold small text-uppercase tracking-wider">Years Experience</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="display-5 fw-extrabold text-success">{{ $stats['completed'] }}</div>
        <div class="text-secondary fw-semibold small text-uppercase tracking-wider">Completed Projects</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="display-5 fw-extrabold text-warning">{{ $stats['active'] }}</div>
        <div class="text-secondary fw-semibold small text-uppercase tracking-wider">Active Projects</div>
      </div>
      <div class="col-6 col-md-3">
        <div class="display-5 fw-extrabold text-info">{{ $stats['happy_clients'] }}</div>
        <div class="text-secondary fw-semibold small text-uppercase tracking-wider">Happy Customers</div>
      </div>
    </div>
  </div>
</section>

<!-- Services Grid Section -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="text-primary fw-bold text-uppercase tracking-wider small">What We Do</span>
      <h2 class="display-6 fw-bold mt-1">Our Professional Painting Services</h2>
      <p class="text-secondary">Tailored execution for every property type — executed with dust-free sanding and weather-proof guarantees.</p>
    </div>

    <div class="row g-4">
      @foreach($services as $service)
        <div class="col-md-6 col-lg-4">
          <div class="service-card d-flex flex-column justify-content-between">
            <div>
              <div class="service-icon-box mb-3">
                <i class="fa-solid {{ $service->icon }}"></i>
              </div>
              <h3 class="h5 fw-bold mb-2">{{ $service->title }}</h3>
              <p class="text-secondary small mb-3">{{ $service->short_description }}</p>
              
              @if(!empty($service->features))
                <ul class="list-unstyled small text-secondary mb-4">
                  @foreach(array_slice($service->features, 0, 3) as $feat)
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-2"></i>{{ $feat }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div>
              <a href="{{ route('services.detail', $service->slug) }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">
                Explore Service &rarr;
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Interactive Before & After Transformation Section -->
<section class="py-5 bg-dark text-white">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
      <div>
        <span class="badge bg-danger rounded-pill px-3 py-1 mb-2">REAL RESULTS</span>
        <h2 class="display-6 fw-bold text-white mb-0">Before & After Visual Transformations</h2>
        <p class="text-secondary mb-0 mt-2">Watch the interactive comparison to see how we turn weathered walls into modern masterpieces.</p>
      </div>
      <a href="{{ route('before-after') }}" class="btn btn-outline-light rounded-pill mt-3 mt-md-0 fw-semibold">
        View All Before & After Cases &rarr;
      </a>
    </div>

    <div class="row g-4">
      @foreach($beforeAfterProjects as $p)
        <div class="col-md-6">
          <div class="bg-secondary bg-opacity-10 p-3 rounded-4 border border-secondary border-opacity-25">
            <div class="ba-container mb-3">
              <img src="{{ asset($p->after_image) }}" class="ba-image-after" alt="{{ $p->title }} After">
              <div class="ba-image-before-wrapper">
                <img src="{{ asset($p->before_image) }}" class="ba-image-before" alt="{{ $p->title }} Before">
              </div>
              <div class="ba-handle"><i class="fa-solid fa-arrows-left-right"></i></div>
              <span class="ba-label-before">BEFORE</span>
              <span class="ba-label-after">AFTER</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4 class="h6 fw-bold text-white mb-1">{{ $p->title }}</h4>
                <div class="small text-secondary"><i class="fa-solid fa-location-dot me-1 text-danger"></i> {{ $p->location }} &bull; {{ $p->area_sqft }}</div>
              </div>
              <a href="{{ route('projects.detail', $p->slug) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                Details
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Featured Projects Section -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
      <div>
        <span class="text-primary fw-bold text-uppercase tracking-wider small">Our Portfolio</span>
        <h2 class="display-6 fw-bold mt-1">Completed & Active Projects</h2>
        <p class="text-secondary mb-0">Explore our real-world work handled from enquiry to completion.</p>
      </div>
      <a href="{{ route('projects') }}" class="btn btn-primary rounded-pill fw-semibold mt-3 mt-md-0">
        Browse All Projects &rarr;
      </a>
    </div>

    <div class="row g-4">
      @foreach($projects as $proj)
        <div class="col-md-6 col-lg-4">
          <div class="project-card h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="position-relative">
                <img src="{{ asset($proj->cover_image) }}" class="w-100 object-fit-cover" style="height: 220px;" alt="{{ $proj->title }}">
                <span class="project-badge">{{ $proj->property_type }}</span>
                <span class="badge position-absolute bottom-0 end-0 m-3 {{ $proj->status == 'Completed' ? 'bg-success' : 'bg-primary' }} rounded-pill px-3 py-1">
                  {{ $proj->status }} ({{ $proj->progress_percent }}%)
                </span>
              </div>
              <div class="p-4">
                <h3 class="h5 fw-bold mb-2">{{ $proj->title }}</h3>
                <div class="small text-secondary mb-3 d-flex flex-wrap gap-3">
                  <span><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $proj->location }}</span>
                  <span><i class="fa-solid fa-ruler-combined text-primary me-1"></i> {{ $proj->area_sqft }}</span>
                  <span><i class="fa-solid fa-calendar text-warning me-1"></i> {{ $proj->year_completed ?? '2026' }}</span>
                </div>
                <p class="text-secondary small mb-3">{{ Str::limit($proj->description, 100) }}</p>
                
                <!-- Live Progress Bar -->
                <div class="mb-2">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Project Progress</span>
                    <span class="text-primary">{{ $proj->progress_percent }}%</span>
                  </div>
                  <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ $proj->progress_percent }}%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-4 pt-0">
              <a href="{{ route('projects.detail', $proj->slug) }}" class="btn btn-outline-dark rounded-pill w-100 fw-semibold">
                View Full Case Study
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-white border-top">
  <div class="container py-4">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="text-primary fw-bold text-uppercase tracking-wider small">The GC Advantage</span>
      <h2 class="display-6 fw-bold mt-1">Why Homeowners & Businesses Choose Us</h2>
      <p class="text-secondary">Over two decades of building trust with quality paints and transparent execution.</p>
    </div>

    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light h-100 border">
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
            <i class="fa-solid fa-user-gear fs-2"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">22+ Years Experience</h4>
          <p class="text-secondary small mb-0">Led directly by master painter G. Chandran. We bring deep technical knowledge of Tamil Nadu monsoon weather and wall moisture dynamics.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light h-100 border">
          <div class="rounded-circle bg-success bg-opacity-10 text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
            <i class="fa-solid fa-shield-virus fs-2"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">100% Original Premium Paints</h4>
          <p class="text-secondary small mb-0">We only use top-grade Asian Paints (Apex Ultima, Royale) and Dulux paints with sealed factory cans brought directly to your site.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 bg-light h-100 border">
          <div class="rounded-circle bg-warning bg-opacity-10 text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
            <i class="fa-solid fa-timeline fs-2"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">Live Progress Tracking</h4>
          <p class="text-secondary small mb-0">Our custom project portal allows clients to track progress %, view daily site photos, and review quotations transparently online.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="text-primary fw-bold text-uppercase tracking-wider small">Testimonials</span>
      <h2 class="display-6 fw-bold mt-1">What Our Clients Say</h2>
    </div>

    <div class="row g-4">
      @foreach($testimonials as $t)
        <div class="col-md-4">
          <div class="bg-white p-4 rounded-4 shadow-sm border h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="text-warning mb-3">
                @for($i=0; $i<$t->rating; $i++)
                  <i class="fa-solid fa-star"></i>
                @endfor
              </div>
              <p class="text-secondary fst-italic mb-4">"{{ $t->review_text }}"</p>
            </div>
            <div class="d-flex align-items-center gap-3 pt-3 border-top">
              <img src="{{ asset($t->avatar ?? 'images/avatar1.svg') }}" class="rounded-circle" width="48" height="48" alt="{{ $t->client_name }}">
              <div>
                <div class="fw-bold fs-6">{{ $t->client_name }}</div>
                <div class="small text-secondary"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $t->location }}</div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Quick Quote CTA Banner -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden">
  <div class="container position-relative z-1 py-3">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h2 class="display-6 fw-bold mb-2">Ready to Give Your Property a Fresh New Look?</h2>
        <p class="lead opacity-90 mb-0">Get a free on-site estimate and professional color consultation within 24 hours.</p>
      </div>
      <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
        <a href="{{ route('quote') }}" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold text-dark shadow">
          <i class="fa-solid fa-calculator me-2"></i> Request Free Quote
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
