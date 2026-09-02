@extends('layouts.admin')

@section('title', 'Project Management')
@section('header_title', 'Project Pipeline Management')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="h5 fw-bold mb-1">All Painting Projects</h3>
      <p class="text-secondary small mb-0">Track projects across all status stages: Enquiry &rarr; Site Visit &rarr; Quotation &rarr; Approved &rarr; In Progress &rarr; Completed</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
      <i class="fa-solid fa-plus me-1"></i> Add New Project
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-light small text-uppercase">
        <tr>
          <th>Project</th>
          <th>Location & Type</th>
          <th>Status Pipeline</th>
          <th>Progress %</th>
          <th>Total Amount</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="small">
        @foreach($projects as $p)
          <tr>
            <td>
              <strong class="text-dark fs-6">{{ $p->title }}</strong>
              <div class="text-muted fs-8">Customer: {{ $p->customer ? $p->customer->name : 'N/A' }}</div>
            </td>
            <td>
              <div>{{ $p->location }}</div>
              <span class="badge bg-light text-dark border fs-8">{{ $p->property_type }}</span>
            </td>
            <td>
              <span class="badge {{ $p->status == 'Completed' ? 'bg-success' : ($p->status == 'In Progress' ? 'bg-primary' : 'bg-warning text-dark') }} rounded-pill px-3 py-1">
                {{ $p->status }}
              </span>
            </td>
            <td style="width: 180px;">
              <div class="d-flex justify-content-between fs-8 fw-bold mb-1">
                <span>Progress</span>
                <span>{{ $p->progress_percent }}%</span>
              </div>
              <div class="progress-bar-container" style="height: 8px;">
                <div class="progress-bar-fill" style="width: {{ $p->progress_percent }}%;"></div>
              </div>
            </td>
            <td class="fw-bold text-dark">₹{{ number_format($p->total_amount, 2) }}</td>
            <td class="text-end">
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Manage & Photos" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{ route('projects.detail', $p->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="View Case Study Page" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $projects->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
