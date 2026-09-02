@extends('layouts.app')

@section('title', $project->title . ' — Project Case Study')

@section('content')

<!-- Project Banner Header -->
<section class="py-5 bg-dark text-white">
  <div class="container py-3">
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
      <span class="badge bg-primary rounded-pill px-3 py-1">{{ $project->property_type }}</span>
      <span class="badge {{ $project->status == 'Completed' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-3 py-1 fw-bold">
        {{ $project->status }} ({{ $project->progress_percent }}%)
      </span>
      @if($project->show_before_after)
        <span class="badge bg-danger rounded-pill px-3 py-1"><i class="fa-solid fa-sliders me-1"></i> Before & After Available</span>
      @endif
    </div>

    <h1 class="display-5 fw-bold mb-3">{{ $project->title }}</h1>
    
    <div class="d-flex flex-wrap gap-4 text-light opacity-90 fs-6">
      <div><i class="fa-solid fa-location-dot text-danger me-2"></i> <strong>Location:</strong> {{ $project->location }}</div>
      <div><i class="fa-solid fa-building text-info me-2"></i> <strong>Property Type:</strong> {{ $project->property_type }}</div>
      <div><i class="fa-solid fa-calendar text-warning me-2"></i> <strong>Completed:</strong> {{ $project->year_completed ?? '2026' }}</div>
      <div><i class="fa-solid fa-ruler-combined text-success me-2"></i> <strong>Area:</strong> {{ $project->area_sqft }}</div>
      <div><i class="fa-solid fa-paint-roller text-primary me-2"></i> <strong>Work:</strong> {{ $project->work_details ?? $project->painting_type }}</div>
    </div>
  </div>
</section>

<!-- Main Detail Content -->
<section class="py-5 bg-white">
  <div class="container py-3">
    <div class="row g-5">
      <div class="col-lg-8">

        <!-- Before & After Interactive Slider (if enabled) -->
        @if($project->show_before_after && $project->before_image && $project->after_image)
          <div class="mb-5">
            <h3 class="h4 fw-bold mb-3 d-flex align-items-center gap-2">
              <i class="fa-solid fa-sliders text-danger"></i> Interactive Before & After Transformation
            </h3>
            <p class="text-secondary small mb-3">Compare original wall conditions vs finished painting with visual comparison.</p>
            
            <div class="ba-container" style="height: 440px;">
              <img src="{{ asset($project->after_image) }}" class="ba-image-after" alt="{{ $project->title }} After">
              <div class="ba-image-before-wrapper">
                <img src="{{ asset($project->before_image) }}" class="ba-image-before" alt="{{ $project->title }} Before">
              </div>
              <div class="ba-handle"><i class="fa-solid fa-arrows-left-right"></i></div>
              <span class="ba-label-before">BEFORE</span>
              <span class="ba-label-after">AFTER</span>
            </div>
          </div>
        @endif

        <!-- Project Overview -->
        <h3 class="h4 fw-bold mb-3">Project Details & Case Study</h3>
        <p class="fs-5 text-secondary lh-relaxed mb-4">{{ $project->description }}</p>

        <!-- Technical Specs & Materials Used -->
        <div class="row g-3 mb-5">
          <div class="col-md-6">
            <div class="p-4 bg-light rounded-4 border">
              <h5 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-boxes-packing me-2"></i> Materials & Paint Used</h5>
              <p class="text-secondary small mb-0">{{ $project->materials_used ?? 'Asian Paints Apex Ultima Protek Elastomeric Emulsion, Anti-Fungal Waterproof Primer, Polyurethane Crack Fillers.' }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 bg-light rounded-4 border">
              <h5 class="fw-bold mb-3 text-success"><i class="fa-solid fa-user-shield me-2"></i> Execution Team</h5>
              <p class="text-secondary small mb-0"><strong>Supervisor:</strong> {{ $project->team_supervisor ?? 'G. Chandran (Master Painter)' }}<br><strong>Warranty:</strong> 5-Year Weather Shield Protection</p>
            </div>
          </div>
        </div>

        <!-- Project Timeline & Progress Updates -->
        @if(count($project->updates) > 0)
          <h3 class="h4 fw-bold mb-4"><i class="fa-solid fa-list-check me-2 text-primary"></i> Project Timeline & Live Progress Updates</h3>
          <div class="position-relative border-start border-3 border-primary ms-3 ps-4 mb-5">
            @foreach($project->updates as $upd)
              <div class="mb-4 position-relative">
                <div class="position-absolute top-0 start-0 translate-middle-x bg-primary text-white rounded-circle p-1 ms-n4 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; left: -25px;">
                  <i class="fa-solid fa-check fs-8"></i>
                </div>
                <div class="bg-light p-4 rounded-4 border">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold text-dark mb-0 fs-6">{{ $upd->title }}</h5>
                    <span class="badge bg-primary rounded-pill px-3">{{ $upd->progress_percent }}% Complete</span>
                  </div>
                  <p class="text-secondary small mb-2">{{ $upd->description }}</p>
                  <small class="text-muted"><i class="fa-solid fa-clock me-1"></i> {{ $upd->created_at->format('M d, Y') }}</small>
                </div>
              </div>
            @endforeach
          </div>
        @endif

        <!-- Photo Gallery (Before, During, After) -->
        @if(count($project->images) > 0)
          <h3 class="h4 fw-bold mb-3"><i class="fa-solid fa-camera me-2 text-warning"></i> Complete Photo Album</h3>
          <div class="row g-3">
            @foreach($project->images as $img)
              <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                  <img src="{{ asset($img->image_path) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $img->caption }}">
                  <div class="card-body p-2 text-center bg-light">
                    <span class="badge {{ $img->type == 'before' ? 'bg-danger' : ($img->type == 'after' ? 'bg-success' : 'bg-primary') }} rounded-pill px-2 py-1 uppercase text-uppercase">
                      {{ $img->type }}
                    </span>
                    @if($img->caption)
                      <div class="small text-secondary mt-1 fs-8">{{ $img->caption }}</div>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif

      </div>

      <!-- Sidebar CTA & Progress Summary -->
      <div class="col-lg-4">
        <div class="p-4 bg-light rounded-4 border shadow-sm sticky-top" style="top: 90px; z-index: 10;">
          <h3 class="h5 fw-bold mb-3">Project Status Summary</h3>

          <div class="mb-4">
            <div class="d-flex justify-content-between small fw-bold mb-1">
              <span>Overall Progress</span>
              <span class="text-primary">{{ $project->progress_percent }}%</span>
            </div>
            <div class="progress-bar-container" style="height: 16px;">
              <div class="progress-bar-fill" style="width: {{ $project->progress_percent }}%;"></div>
            </div>
          </div>

          <ul class="list-unstyled small text-secondary d-flex flex-column gap-3 mb-4 border-top pt-3">
            <li class="d-flex justify-content-between">
              <span>Property Type:</span> <strong class="text-dark">{{ $project->property_type }}</strong>
            </li>
            <li class="d-flex justify-content-between">
              <span>Location:</span> <strong class="text-dark">{{ $project->location }}</strong>
            </li>
            <li class="d-flex justify-content-between">
              <span>Approx Area:</span> <strong class="text-dark">{{ $project->area_sqft }}</strong>
            </li>
            <li class="d-flex justify-content-between">
              <span>Start Date:</span> <strong class="text-dark">{{ $project->start_date ? $project->start_date->format('M d, Y') : 'Aug 2026' }}</strong>
            </li>
            <li class="d-flex justify-content-between">
              <span>Status:</span> <span class="badge {{ $project->status == 'Completed' ? 'bg-success' : 'bg-primary' }}">{{ $project->status }}</span>
            </li>
          </ul>

          <div class="border-top pt-3 text-center">
            <p class="small text-secondary mb-3">Want similar quality painting for your house or building?</p>
            <a href="{{ route('quote') }}" class="btn btn-warning rounded-pill w-100 fw-bold py-2 text-dark mb-2">
              <i class="fa-solid fa-calculator me-1"></i> Request Quote Like This
            </a>
            <a href="https://wa.me/918925014875?text=Hi%20GC%20Painting!%20I%20saw%20project%20{{ urlencode($project->title) }}" target="_blank" class="btn btn-success rounded-pill w-100 fw-bold py-2">
              <i class="fa-brands fa-whatsapp me-1"></i> Inquire on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
