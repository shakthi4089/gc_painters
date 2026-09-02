@extends('layouts.admin')

@section('title', 'Create New Project')
@section('header_title', 'Create New Painting Project')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm max-w-900 mx-auto">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h3 class="h5 fw-bold mb-0">Project Details</h3>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">&larr; Back to Projects</a>
  </div>

  <form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf

    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <label class="form-label fw-bold small">Project Title *</label>
        <input type="text" name="title" class="form-control rounded-3" required placeholder="e.g. Royal Apartment Block A Exterior Painting">
      </div>
      <div class="col-md-4">
        <label class="form-label fw-bold small">Customer</label>
        <select name="customer_id" class="form-select rounded-3">
          <option value="">Select Existing Customer...</option>
          @foreach($customers as $c)
            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->phone }})</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="form-label fw-bold small">Property Type *</label>
        <select name="property_type" class="form-select rounded-3" required>
          @foreach(config('custom-app.property_types') as $key => $label)
            <option value="{{ $key }}" {{ $key == 'Apartment' ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label fw-bold small">Painting Type *</label>
        <select name="painting_type" class="form-select rounded-3" required>
          <option value="Interior">Interior Painting</option>
          <option value="Exterior" selected>Exterior Painting</option>
          <option value="Both">Both Interior & Exterior</option>
          <option value="Epoxy Flooring">Epoxy Flooring</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label fw-bold small">Location *</label>
        <input type="text" name="location" class="form-control rounded-3" required placeholder="e.g. Chennai / Avadi">
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="form-label fw-bold small">Area (sq.ft)</label>
        <input type="text" name="area_sqft" class="form-control rounded-3" placeholder="e.g. 25,000 sq.ft">
      </div>

      <div class="col-md-4">
        <label class="form-label fw-bold small">Status Stage *</label>
        <select name="status" class="form-select rounded-3" required>
          @foreach(config('custom-app.project_statuses') as $key => $label)
            <option value="{{ $key }}" {{ $key == 'In Progress' ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label fw-bold small">Progress Percentage (0–100%) *</label>
        <input type="number" name="progress_percent" class="form-control rounded-3" value="10" min="0" max="100" required>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold small">Total Agreed Amount (₹) *</label>
        <input type="number" step="0.01" name="total_amount" class="form-control rounded-3" required placeholder="e.g. 485000">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold small">Advance Paid Amount (₹)</label>
        <input type="number" step="0.01" name="paid_amount" class="form-control rounded-3" placeholder="e.g. 150000">
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-bold small">Project Overview / Description</label>
      <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Detailed project scope, work schedule, surface preparation required..."></textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
      <i class="fa-solid fa-check me-2"></i> Save & Create Project
    </button>
  </form>
</div>
@endsection
