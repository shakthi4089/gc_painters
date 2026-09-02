@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Business Dashboard')

@section('content')

<!-- Replace Top Row Cards with Single Visual Pie Chart Component -->
<div class="bg-white rounded-4 border p-4 shadow-sm mb-4">
  <div class="row align-items-center">
    <div class="col-lg-5 col-md-6 mb-3 mb-md-0">
      <h3 class="h5 fw-bold text-dark mb-1"><i class="fa-solid fa-chart-pie text-primary me-2"></i> Business Overview</h3>
      <p class="text-secondary small mb-3">Live status metrics across enquiries, active projects, and quotations.</p>
      
      <div class="d-flex flex-column gap-2">
        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light border-start border-4 border-primary">
          <span class="small fw-semibold text-dark"><i class="fa-solid fa-inbox text-primary me-2"></i> New Enquiries</span>
          <span class="badge bg-primary rounded-pill fs-7">{{ $kpi['new_enquiries'] }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light border-start border-4 border-warning">
          <span class="small fw-semibold text-dark"><i class="fa-solid fa-paint-roller text-warning me-2"></i> Active Projects</span>
          <span class="badge bg-warning text-dark rounded-pill fs-7">{{ $kpi['active_projects'] }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light border-start border-4 border-success">
          <span class="small fw-semibold text-dark"><i class="fa-solid fa-check-double text-success me-2"></i> Completed Projects</span>
          <span class="badge bg-success rounded-pill fs-7">{{ $kpi['completed_projects'] }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light border-start border-4 border-info">
          <span class="small fw-semibold text-dark"><i class="fa-solid fa-file-invoice-dollar text-info me-2"></i> Pending Quotations</span>
          <span class="badge bg-info rounded-pill fs-7">{{ $kpi['pending_quotations'] }}</span>
        </div>
      </div>
    </div>

    <div class="col-lg-7 col-md-6">
      <div style="height: 220px;" class="position-relative d-flex justify-content-center align-items-center">
        <canvas id="businessSummaryPieChart"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <!-- Recent Enquiries Table -->
  <div class="col-lg-7">
    <div class="bg-white rounded-4 border p-4 shadow-sm h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="h6 fw-bold text-dark mb-0">Recent Enquiries</h3>
        <a href="{{ route('admin.enquiries') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
      </div>

      <div class="table-responsive">
        <table class="table align-middle table-hover">
          <thead class="table-light small text-uppercase">
            <tr>
              <th>Customer</th>
              <th>Location</th>
              <th>Type</th>
              <th>Status</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody class="small">
            @foreach($recentEnquiries as $enq)
              <tr>
                <td>
                  <strong class="text-dark">{{ $enq->name }}</strong>
                  <div class="text-muted fs-8">{{ $enq->phone }}</div>
                </td>
                <td>{{ $enq->location }}</td>
                <td><span class="badge bg-light text-dark border">{{ $enq->property_type }}</span></td>
                <td>
                  <span class="badge {{ $enq->status == 'New' ? 'bg-danger' : ($enq->status == 'Converted' ? 'bg-success' : 'bg-primary') }}">
                    {{ $enq->status }}
                  </span>
                </td>
                <td class="text-end">
                  @if($enq->status != 'Converted')
                    <form action="{{ route('admin.enquiries.convert', $enq->id) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-success rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Convert to Project" data-bs-toggle="tooltip">
                        <i class="fa-solid fa-arrow-right"></i>
                      </button>
                    </form>
                  @else
                    <span class="badge bg-success rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Converted"><i class="fa-solid fa-check"></i></span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Active Projects Overview -->
  <div class="col-lg-5">
    <div class="bg-white rounded-4 border p-4 shadow-sm h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="h6 fw-bold text-dark mb-0">Active Projects Pipeline</h3>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Manage</a>
      </div>

      <div class="d-flex flex-column gap-3">
        @foreach($activeProjects as $p)
          <div class="p-3 bg-light rounded-3 border">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <h4 class="h6 fw-bold text-dark mb-0">{{ $p->title }}</h4>
              <span class="badge bg-primary rounded-pill fs-8">{{ $p->progress_percent }}%</span>
            </div>
            <div class="small text-muted mb-2"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $p->location }} &bull; {{ $p->area_sqft }}</div>
            
            <div class="progress-bar-container" style="height: 10px;">
              <div class="progress-bar-fill" style="width: {{ $p->progress_percent }}%;"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top fs-8">
              <span class="text-secondary">Supervisor: {{ $p->team_supervisor ?? 'G. Chandran' }}</span>
              <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" title="Edit & Update Project">
                <i class="fa-solid fa-pen-to-square fs-9"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('businessSummaryPieChart');
  if (ctx) {
    new Chart(ctx.getContext('2d'), {
      type: 'pie',
      data: {
        labels: ['New Enquiries', 'Active Projects', 'Completed Projects', 'Pending Quotations'],
        datasets: [{
          data: [
            {{ $kpi['new_enquiries'] }},
            {{ $kpi['active_projects'] }},
            {{ $kpi['completed_projects'] }},
            {{ $kpi['pending_quotations'] }}
          ],
          backgroundColor: ['#2563eb', '#f59e0b', '#10b981', '#06b6d4'],
          borderWidth: 2,
          borderColor: '#ffffff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
            labels: { boxWidth: 12, font: { size: 12, weight: 'bold' } }
          }
        }
      }
    });
  }
});
</script>

@endsection
