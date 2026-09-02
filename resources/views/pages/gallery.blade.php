@extends('layouts.app')

@section('title', 'Photo Gallery — GC Painting Showcase')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">Project Photo Gallery</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Visual album of our finished exterior, interior, apartment, and industrial painting projects across Chennai.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    
    <!-- Category Filters -->
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
      <button class="btn btn-primary rounded-pill px-4 filter-btn active" data-filter="all">All Photos</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Exterior">Exterior</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Interior">Interior</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Apartment">Apartment</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Residential">Residential</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Industrial">Industrial</button>
    </div>

    <div class="row g-4">
      @foreach($gallery as $g)
        <div class="col-md-6 col-lg-4 filterable-item" data-category="{{ $g->category }}">
          <div class="card border-0 rounded-4 shadow-sm overflow-hidden h-100">
            <img src="{{ asset($g->image_path) }}" class="card-img-top object-fit-cover" style="height: 250px;" alt="{{ $g->title }}">
            <div class="card-body p-3">
              <span class="badge bg-primary rounded-pill px-3 py-1 mb-2">{{ $g->category }}</span>
              <h5 class="fw-bold mb-1 fs-6">{{ $g->title }}</h5>
              <p class="text-secondary small mb-0">{{ $g->description }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
