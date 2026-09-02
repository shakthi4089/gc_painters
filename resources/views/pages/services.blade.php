@extends('layouts.app')

@section('title', 'Painting Services — GC Painting')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">Our Painting Services</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Comprehensive Painting & Surface Coating Solutions for Every Property Type across Chennai.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row g-4">
      @foreach($services as $service)
        <div class="col-md-6 col-lg-4">
          <div class="service-card d-flex flex-column justify-content-between">
            <div>
              <div class="position-relative mb-3 rounded-3 overflow-hidden">
                <img src="{{ asset($service->cover_image) }}" class="w-100 object-fit-cover" style="height: 180px;" alt="{{ $service->title }}">
              </div>
              <div class="d-flex align-items-center gap-3 mb-3">
                <div class="service-icon-box mb-0" style="width: 48px; height: 48px; font-size: 1.25rem;">
                  <i class="fa-solid {{ $service->icon }}"></i>
                </div>
                <h3 class="h5 fw-bold mb-0">{{ $service->title }}</h3>
              </div>
              <p class="text-secondary small mb-3">{{ $service->subtitle }}</p>
              <p class="text-secondary small mb-4">{{ $service->short_description }}</p>

              @if(!empty($service->features))
                <ul class="list-unstyled small text-secondary mb-4">
                  @foreach($service->features as $feat)
                    <li class="mb-1"><i class="fa-solid fa-check text-success me-2"></i>{{ $feat }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div>
              <a href="{{ route('services.detail', $service->slug) }}" class="btn btn-primary rounded-pill w-100 fw-semibold">
                Service Details &rarr;
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
