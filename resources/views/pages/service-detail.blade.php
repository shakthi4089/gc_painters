@extends('layouts.app')

@section('title', $service->title . ' — GC Painting Services')

@section('content')
<section class="py-5 bg-dark text-white">
  <div class="container py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="badge bg-primary rounded-pill px-3 py-2 text-uppercase mb-3">{{ $service->category }}</span>
        <h1 class="display-5 fw-bold mb-3">{{ $service->title }}</h1>
        <p class="lead text-light opacity-75 mb-4">{{ $service->subtitle }}</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="{{ route('quote') }}" class="btn btn-warning btn-lg rounded-pill px-4 fw-bold text-dark">
            <i class="fa-solid fa-calculator me-2"></i> Get Quote for {{ $service->title }}
          </a>
          <a href="https://wa.me/918925014875?text=Hi%20GC%20Painting!%20I%20am%20interested%20in%20{{ urlencode($service->title) }}" target="_blank" class="btn btn-success btn-lg rounded-pill px-4 fw-semibold">
            <i class="fa-brands fa-whatsapp me-2"></i> Ask on WhatsApp
          </a>
        </div>
      </div>
      <div class="col-lg-5">
        <img src="{{ asset($service->cover_image) }}" class="w-100 rounded-4 shadow-lg border border-secondary border-opacity-25" alt="{{ $service->title }}">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="h3 fw-bold mb-4">Service Overview</h2>
        <p class="fs-5 text-secondary lh-relaxed mb-4">{{ $service->full_description }}</p>

        <h3 class="h4 fw-bold mb-3 mt-5">Key Highlights & Inclusions</h3>
        <div class="row g-3 mb-5">
          @if(!empty($service->features))
            @foreach($service->features as $feat)
              <div class="col-md-6">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                  <i class="fa-solid fa-circle-check text-success fs-4"></i>
                  <span class="fw-semibold text-dark">{{ $feat }}</span>
                </div>
              </div>
            @endforeach
          @endif
        </div>

        @if(count($relatedProjects) > 0)
          <h3 class="h4 fw-bold mb-4">Related Completed Projects</h3>
          <div class="row g-4">
            @foreach($relatedProjects as $p)
              <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                  <img src="{{ asset($p->cover_image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $p->title }}">
                  <div class="card-body">
                    <h5 class="card-title fw-bold mb-2 fs-6">{{ $p->title }}</h5>
                    <div class="small text-secondary mb-2"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $p->location }} &bull; {{ $p->area_sqft }}</div>
                    <a href="{{ route('projects.detail', $p->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100 fw-semibold">View Project</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>

      <div class="col-lg-4">
        <div class="p-4 bg-light rounded-4 border shadow-sm sticky-top" style="top: 100px;">
          <h3 class="h5 fw-bold mb-3">Request a Callback</h3>
          <p class="small text-secondary mb-4">Leave your contact details and our master painter G. Chandran will call you back within 2 hours.</p>

          <form action="{{ route('quote.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="property_type" value="{{ $service->category }}">
            <input type="hidden" name="painting_type" value="{{ $service->title }}">

            <div class="mb-3">
              <label class="form-label small fw-bold">Your Name *</label>
              <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Ramesh Kumar">
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control rounded-3" required placeholder="e.g. 9876543210">
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold">Location *</label>
              <input type="text" name="location" class="form-control rounded-3" required placeholder="e.g. Anna Nagar, Chennai">
            </div>

            <button type="submit" class="btn btn-primary rounded-pill w-100 fw-bold py-2">
              <i class="fa-solid fa-paper-plane me-1"></i> Submit Quick Request
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
