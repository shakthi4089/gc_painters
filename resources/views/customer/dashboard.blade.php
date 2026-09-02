@extends('layouts.customer')

@section('title', 'My Projects & Progress')

@section('content')
<div class="container py-3">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 fw-bold mb-1">My Painting Projects</h1>
      <p class="text-secondary small mb-0">Track live progress, uploaded work photos, quotations, and supervisor updates.</p>
    </div>
    <a href="https://wa.me/918925014875?text=Hi%20Chandran!%20I%20have%20a%20question%20about%20my%20painting%20project." target="_blank" class="btn btn-success rounded-pill fw-bold">
      <i class="fa-brands fa-whatsapp me-1"></i> Contact Supervisor
    </a>
  </div>

  @forelse($projects as $p)
    <div class="bg-white rounded-4 border p-4 shadow-sm mb-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 border-bottom pb-3">
        <div>
          <span class="badge bg-primary rounded-pill px-3 py-1 mb-2">{{ $p->property_type }}</span>
          <h2 class="h4 fw-bold text-dark mb-1">{{ $p->title }}</h2>
          <div class="text-secondary small">
            <i class="fa-solid fa-location-dot text-danger me-1"></i> Location: {{ $p->location }} &bull; 
            <i class="fa-solid fa-user me-1 text-primary"></i> Supervisor: {{ $p->team_supervisor ?? 'G. Chandran' }}
          </div>
        </div>

        <div class="mt-3 mt-md-0 text-md-end">
          <span class="badge {{ $p->status == 'Completed' ? 'bg-success' : 'bg-primary' }} fs-6 px-3 py-2 rounded-pill">
            Status: {{ $p->status }}
          </span>
          <div class="small text-muted mt-1">Start: {{ $p->start_date ? $p->start_date->format('d M') : '10 Aug' }} &bull; Expected: {{ $p->expected_end_date ? $p->expected_end_date->format('d M') : '25 Aug' }}</div>
        </div>
      </div>

      <!-- Progress Visual Bar -->
      <div class="mb-4 bg-light p-3 rounded-3 border">
        <div class="d-flex justify-content-between font-monospace fw-bold mb-2">
          <span class="text-dark fs-6">Progress</span>
          <span class="text-primary fs-5">{{ $p->progress_percent }}%</span>
        </div>
        <div class="progress-bar-container" style="height: 18px;">
          <div class="progress-bar-fill" style="width: {{ $p->progress_percent }}%;"></div>
        </div>
      </div>

      <div class="row g-4">
        <!-- Progress Photos Stream -->
        <div class="col-lg-7">
          <h3 class="h6 fw-bold mb-3"><i class="fa-solid fa-camera text-warning me-1"></i> Live Site Photos Uploaded</h3>
          
          <div class="row g-2 mb-3">
            @forelse($p->images as $img)
              <div class="col-6 col-sm-4">
                <div class="border rounded-3 overflow-hidden">
                  <img src="{{ asset($img->image_path) }}" class="w-100 object-fit-cover" style="height: 130px;" alt="{{ $img->caption }}">
                  <div class="p-1 bg-dark text-white fs-8 text-center">{{ strtoupper($img->type) }}</div>
                </div>
              </div>
            @empty
              <p class="text-muted small">Photos will appear here as team uploads daily work progress.</p>
            @endforelse
          </div>

          <!-- Updates Log -->
          @if(count($p->updates) > 0)
            <h4 class="h6 fw-bold mb-2 mt-4"><i class="fa-solid fa-list-check text-primary me-1"></i> Timeline Updates</h4>
            <div class="list-group list-group-flush small">
              @foreach($p->updates as $upd)
                <div class="list-group-item px-0">
                  <div class="d-flex justify-content-between">
                    <strong class="text-dark">{{ $upd->title }}</strong>
                    <span class="badge bg-light text-dark border">{{ $upd->progress_percent }}%</span>
                  </div>
                  <div class="text-secondary mt-1">{{ $upd->description }}</div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        <!-- Payment & Quotation Summary -->
        <div class="col-lg-5">
          <div class="p-3 bg-light rounded-3 border">
            <h3 class="h6 fw-bold mb-3"><i class="fa-solid fa-file-invoice-dollar text-success me-1"></i> Quotation & Payment Status</h3>
            
            <ul class="list-unstyled small text-secondary d-flex flex-column gap-2 mb-3">
              <li class="d-flex justify-content-between">
                <span>Total Agreed Amount:</span> <strong class="text-dark">₹{{ number_format($p->total_amount, 2) }}</strong>
              </li>
              <li class="d-flex justify-content-between">
                <span>Advance Paid:</span> <strong class="text-success">₹{{ number_format($p->paid_amount, 2) }}</strong>
              </li>
              <li class="d-flex justify-content-between border-top pt-2">
                <span>Balance Remaining:</span> <strong class="text-danger">₹{{ number_format($p->total_amount - $p->paid_amount, 2) }}</strong>
              </li>
            </ul>

            @if(count($quotations) > 0)
              <a href="{{ route('admin.quotations.show', $quotations->first()->id) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100 fw-bold mb-2">
                <i class="fa-solid fa-download me-1"></i> View Official Quotation (PDF)
              </a>
            @endif

            <a href="https://wa.me/918925014875?text=Hi%20GC%20Painting!%20I%20want%20to%20check%20payment%20details." target="_blank" class="btn btn-sm btn-success rounded-pill w-100 fw-bold">
              <i class="fa-brands fa-whatsapp me-1"></i> Pay / Confirm Payment via WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="p-5 text-center bg-white rounded-4 border">
      <i class="fa-solid fa-paint-roller fs-1 text-muted mb-3"></i>
      <h3 class="h5 fw-bold">No Active Projects Found</h3>
      <p class="text-secondary small">You currently have no active project assigned to your login.</p>
      <a href="{{ route('quote') }}" class="btn btn-primary rounded-pill px-4">Request a Quote</a>
    </div>
  @endforelse

</div>
@endsection
