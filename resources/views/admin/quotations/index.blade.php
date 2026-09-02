@extends('layouts.admin')

@section('title', 'Quotation Management')
@section('header_title', 'Estimate & Quotation Generator')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="h5 fw-bold mb-1">Generated Estimates & Quotations</h3>
      <p class="text-secondary small mb-0">Create formal line-item quotes with sq.ft rates for customers.</p>
    </div>
    <a href="{{ route('admin.quotations.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-dark">
      <i class="fa-solid fa-plus me-1"></i> Create New Quotation
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-light small text-uppercase">
        <tr>
          <th>Quote #</th>
          <th>Customer</th>
          <th>Location</th>
          <th>Date</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="small">
        @foreach($quotations as $q)
          <tr>
            <td class="fw-bold text-primary">{{ $q->quotation_number }}</td>
            <td>
              <strong class="text-dark">{{ $q->customer_name }}</strong>
              <div class="text-muted fs-8">{{ $q->customer_phone }}</div>
            </td>
            <td>{{ $q->property_location }}</td>
            <td>{{ $q->quote_date ? $q->quote_date->format('M d, Y') : 'N/A' }}</td>
            <td class="fw-bold text-dark">₹{{ number_format($q->total_amount, 2) }}</td>
            <td>
              <span class="badge {{ $q->status == 'Approved' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-3 py-1">
                {{ $q->status }}
              </span>
            </td>
            <td class="text-end">
              <a href="{{ route('admin.quotations.show', $q->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="View & Print Estimate" data-bs-toggle="tooltip">
                <i class="fa-solid fa-file-invoice-dollar"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
