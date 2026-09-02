@extends('layouts.app')

@section('title', 'Before & After Transformation Gallery — GC Painting')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <span class="badge bg-danger rounded-pill px-3 py-2 text-uppercase mb-3"><i class="fa-solid fa-sliders me-1"></i> Interactive Comparison</span>
    <h1 class="display-5 fw-bold">Before & After Painting Showcase</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Real transformation proofs across Chennai. Inspect our surface repair and finishing quality with visual image comparison.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row g-5">
      @foreach($projects as $p)
        <div class="col-lg-6">
          <div class="bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <span class="badge bg-primary rounded-pill px-3 py-1 mb-1">{{ $p->property_type }}</span>
                  <h3 class="h5 fw-bold text-dark mb-0">{{ $p->title }}</h3>
                </div>
                <span class="badge bg-success rounded-pill px-3 py-1">{{ $p->year_completed ?? '2026' }}</span>
              </div>

              <!-- Interactive Slider -->
              <div class="ba-container mb-3" style="height: 380px;">
                <img src="{{ asset($p->after_image) }}" class="ba-image-after" alt="{{ $p->title }} After">
                <div class="ba-image-before-wrapper">
                  <img src="{{ asset($p->before_image) }}" class="ba-image-before" alt="{{ $p->title }} Before">
                </div>
                <div class="ba-handle"><i class="fa-solid fa-arrows-left-right"></i></div>
                <span class="ba-label-before">BEFORE</span>
                <span class="ba-label-after">AFTER</span>
              </div>

              <div class="small text-secondary mb-3">
                <i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $p->location }} &bull; 
                <i class="fa-solid fa-ruler-combined me-1 text-primary"></i> {{ $p->area_sqft }} &bull; 
                <i class="fa-solid fa-paint-roller me-1 text-warning"></i> {{ $p->work_details ?? $p->painting_type }}
              </div>
            </div>

            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
              <a href="{{ route('projects.detail', $p->slug) }}" class="btn btn-outline-dark btn-sm rounded-pill fw-semibold">
                Read Full Case Study
              </a>
              <a href="{{ route('quote') }}" class="btn btn-warning btn-sm rounded-pill fw-bold text-dark">
                Request Quote Like This
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
