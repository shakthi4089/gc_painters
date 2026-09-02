@extends('layouts.admin')

@section('title', 'Manage Project: ' . $project->title)
@section('header_title', 'Project Management Workspace')

@section('content')
<div class="row g-4">
  <!-- Left Side: Main Details & Progress Update Form -->
  <div class="col-lg-7">
    <div class="bg-white rounded-4 border p-4 shadow-sm mb-4">
      <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
          <h3 class="h5 fw-bold mb-1">{{ $project->title }}</h3>
          <span class="badge bg-primary rounded-pill">{{ $project->property_type }}</span>
          <span class="badge bg-success rounded-pill">Status: {{ $project->status }}</span>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">&larr; All Projects</a>
      </div>

      <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
        @csrf

        <div class="row g-3 mb-4">
          <div class="col-md-8">
            <label class="form-label fw-bold small">Project Title *</label>
            <input type="text" name="title" class="form-control rounded-3" value="{{ $project->title }}" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-bold small">Location *</label>
            <input type="text" name="location" class="form-control rounded-3" value="{{ $project->location }}" required>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold small">Status Pipeline Stage *</label>
            <select name="status" class="form-select rounded-3" required>
              @foreach(config('custom-app.project_statuses') as $key => $label)
                <option value="{{ $key }}" {{ $project->status == $key ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold small">Project Progress % (0–100) *</label>
            <div class="d-flex align-items-center gap-2">
              <input type="range" class="form-range flex-grow-1" min="0" max="100" name="progress_percent" value="{{ $project->progress_percent }}" oninput="document.getElementById('p_val').innerText = this.value + '%'">
              <span id="p_val" class="badge bg-primary fs-6 px-3 py-2">{{ $project->progress_percent }}%</span>
            </div>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold small">Total Agreed Amount (₹)</label>
            <input type="number" step="0.01" name="total_amount" class="form-control rounded-3" value="{{ $project->total_amount }}">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold small">Paid Amount (₹)</label>
            <input type="number" step="0.01" name="paid_amount" class="form-control rounded-3" value="{{ $project->paid_amount }}">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold small">Work Details / Materials Used</label>
          <input type="text" name="materials_used" class="form-control rounded-3" value="{{ $project->materials_used }}" placeholder="e.g. Asian Paints Apex Ultima Protek, Damp Seal Primer">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold small">Team Supervisor</label>
          <input type="text" name="team_supervisor" class="form-control rounded-3" value="{{ $project->team_supervisor }}" placeholder="e.g. G. Chandran (Master Painter)">
        </div>

        <div class="p-3 bg-light rounded-3 border mb-4">
          <h5 class="fw-bold small text-primary mb-2"><i class="fa-solid fa-bullhorn me-1"></i> Post a Live Progress Update to Customer</h5>
          <div class="mb-2">
            <input type="text" name="update_title" class="form-control form-control-sm rounded-2" placeholder="e.g. Primer Coat Completed on East Elevation">
          </div>
          <div>
            <textarea name="update_description" class="form-control form-control-sm rounded-2" rows="2" placeholder="Update notes visible to customer portal..."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
          <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes & Log Update
        </button>
      </form>
    </div>
  </div>

  <!-- Right Side: Before / During / After Photo Manager -->
  <div class="col-lg-5">
    <div class="bg-white rounded-4 border p-4 shadow-sm mb-4">
      <h3 class="h6 fw-bold mb-3"><i class="fa-solid fa-cloud-arrow-up text-primary me-2"></i> Upload Project Photo</h3>
      
      <form action="{{ route('admin.projects.image', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
          <label class="form-label small fw-bold">Photo Type *</label>
          <select name="type" class="form-select form-select-sm rounded-2" required>
            <option value="before">BEFORE (Initial Condition)</option>
            <option value="during">DURING (Work in Progress)</option>
            <option value="after" selected>AFTER (Finished Result)</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold">Select Image File *</label>
          <input type="file" name="image" class="form-control form-control-sm rounded-2" accept="image/*" required>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold">Caption / Note</label>
          <input type="text" name="caption" class="form-control form-control-sm rounded-2" placeholder="e.g. Scaffolding & Primer Coat">
        </div>

        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold w-100">
          <i class="fa-solid fa-upload me-1"></i> Upload Photo
        </button>
      </form>
    </div>

    <!-- Existing Photos List -->
    <div class="bg-white rounded-4 border p-4 shadow-sm">
      <h3 class="h6 fw-bold mb-3">Project Media Gallery ({{ count($project->images) }})</h3>
      
      <div class="row g-2">
        @forelse($project->images as $img)
          <div class="col-6">
            <div class="border rounded-2 overflow-hidden position-relative">
              <img src="{{ asset($img->image_path) }}" class="w-100 object-fit-cover" style="height: 110px;" alt="{{ $img->caption }}">
              <span class="badge position-absolute top-0 start-0 m-1 {{ $img->type == 'before' ? 'bg-danger' : ($img->type == 'after' ? 'bg-success' : 'bg-primary') }} fs-8">
                {{ strtoupper($img->type) }}
              </span>
              @if($img->caption)
                <div class="p-1 bg-dark text-white fs-8 text-truncate">{{ $img->caption }}</div>
              @endif
            </div>
          </div>
        @empty
          <p class="text-muted small mb-0">No photos uploaded yet.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
