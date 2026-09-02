@extends('layouts.admin')

@section('title', 'Customer Enquiries')
@section('header_title', 'Customer Lead Enquiries')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h5 fw-bold mb-0">Incoming Quote Requests</h3>
    <span class="badge bg-primary rounded-pill px-3 py-2">Total Enquiries: {{ $enquiries->total() }}</span>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-light small text-uppercase">
        <tr>
          <th>Date</th>
          <th>Customer</th>
          <th>Property / Location</th>
          <th>Painting Type</th>
          <th>Area / Floors</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody class="small">
        @foreach($enquiries as $enq)
          <tr>
            <td>{{ $enq->created_at->format('M d, Y') }}</td>
            <td>
              <strong class="text-dark">{{ $enq->name }}</strong>
              <div class="text-muted fs-8">{{ $enq->phone }} | {{ $enq->email ?? 'No Email' }}</div>
            </td>
            <td>
              <strong>{{ $enq->property_type }}</strong>
              <div class="text-muted fs-8"><i class="fa-solid fa-location-dot text-danger"></i> {{ $enq->location }}</div>
            </td>
            <td><span class="badge bg-light text-dark border">{{ $enq->painting_type }}</span></td>
            <td>{{ $enq->approx_area ?? 'N/A' }} <br><span class="text-muted fs-8">{{ $enq->floors }}</span></td>
            <td>
              <span class="badge {{ $enq->status == 'New' ? 'bg-danger' : ($enq->status == 'Converted' ? 'bg-success' : 'bg-primary') }}">
                {{ $enq->status }}
              </span>
            </td>
            <td class="text-end">
              <div class="d-flex justify-content-end gap-2">
                @if($enq->status != 'Converted')
                  <form action="{{ route('admin.enquiries.convert', $enq->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Convert to Project" data-bs-toggle="tooltip">
                      <i class="fa-solid fa-bolt"></i>
                    </button>
                  </form>
                @endif
                <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $enq->phone) }}?text=Hello%20{{ urlencode($enq->name) }}!%20This%20is%20G.%20Chandran%20from%20GC%20Painting." target="_blank" class="btn btn-sm btn-outline-success rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="WhatsApp Customer" data-bs-toggle="tooltip">
                  <i class="fa-brands fa-whatsapp"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $enquiries->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
