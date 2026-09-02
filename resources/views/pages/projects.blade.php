@extends('layouts.app')

@section('title', 'Our Projects — Completed & Active Portfolio')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">Our Completed & Active Projects</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Explore real-world painting transformations handled from initial site survey to complete handover.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    
    <!-- Category Filter Bar -->
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
      <button class="btn btn-primary rounded-pill px-4 filter-btn active" data-filter="all">All Projects</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="House">House & Villa</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Apartment">Apartment Complex</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Commercial">Commercial & IT</button>
      <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="Industrial">Industrial Epoxy</button>
    </div>

    <div class="row g-4" id="projectsGrid">
      @forelse($projects as $p)
        <div class="col-md-6 col-lg-4 filterable-item" data-category="{{ $p->property_type }}">
          <div class="project-card h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="position-relative">
                <img src="{{ asset($p->cover_image) }}" class="w-100 object-fit-cover" style="height: 220px;" alt="{{ $p->title }}">
                <span class="project-badge">{{ $p->property_type }}</span>
                <span class="badge position-absolute bottom-0 end-0 m-3 {{ $p->status == 'Completed' ? 'bg-success' : 'bg-primary' }} rounded-pill px-3 py-1">
                  {{ $p->status }} ({{ $p->progress_percent }}%)
                </span>
              </div>
              <div class="p-4">
                <h3 class="h5 fw-bold mb-2">{{ $p->title }}</h3>
                <div class="small text-secondary mb-3 d-flex flex-wrap gap-3">
                  <span><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $p->location }}</span>
                  <span><i class="fa-solid fa-ruler-combined text-primary me-1"></i> {{ $p->area_sqft }}</span>
                  <span><i class="fa-solid fa-calendar text-warning me-1"></i> {{ $p->year_completed ?? '2026' }}</span>
                </div>
                <p class="text-secondary small mb-3">{{ Str::limit($p->description, 110) }}</p>
                
                <!-- Live Progress Bar -->
                <div class="mb-2">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Project Progress</span>
                    <span class="text-primary">{{ $p->progress_percent }}%</span>
                  </div>
                  <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ $p->progress_percent }}%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-4 pt-0">
              <a href="{{ route('projects.detail', $p->slug) }}" class="btn btn-outline-dark rounded-pill w-100 fw-semibold">
                View Project Details & Photos &rarr;
              </a>
            </div>
          </div>
        </div>
      @empty
      @endforelse
    </div>

    <!-- Empty State Container -->
    <div id="noProjectsMessage" class="text-center py-5" style="display: {{ $projects->isEmpty() ? 'block' : 'none' }};">
      <div class="mb-3">
        <i class="fa-solid fa-folder-open text-secondary opacity-50" style="font-size: 4rem;"></i>
      </div>
      <h3 class="fw-bold text-dark mb-2">No Projects Found</h3>
      <p class="text-secondary mb-4">We don't have any projects matching this category right now.</p>
      <button class="btn btn-primary rounded-pill px-4 filter-btn-reset" onclick="document.querySelector('.filter-btn[data-filter=\'all\']').click()">View All Projects</button>
    </div>

    <div class="mt-5 d-flex justify-content-center">
      {{ $projects->links('pagination::bootstrap-5') }}
    </div>
  </div>
</section>
@endsection
