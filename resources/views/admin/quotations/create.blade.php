@extends('layouts.admin')

@section('title', 'Create Quotation')
@section('header_title', 'Create Formal Estimate & Quotation')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm max-w-900 mx-auto">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h3 class="h5 fw-bold mb-0">Customer & Site Information</h3>
    <a href="{{ route('admin.quotations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">&larr; Back to Quotations</a>
  </div>

  <form action="{{ route('admin.quotations.store') }}" method="POST">
    @csrf

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold small">Customer Name *</label>
        <input type="text" name="customer_name" class="form-control rounded-3" required placeholder="e.g. Ramesh Kumar">
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small">Phone Number *</label>
        <input type="tel" name="customer_phone" class="form-control rounded-3" required placeholder="e.g. 9840123456">
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold small">Property Location *</label>
        <input type="text" name="property_location" class="form-control rounded-3" required placeholder="e.g. Anna Nagar, Chennai">
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small">Quotation Date *</label>
        <input type="date" name="quote_date" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
      </div>
    </div>

    <!-- Line Items Section -->
    <h4 class="h6 fw-bold mb-3 text-primary border-bottom pb-2">Work Items Breakdown (Sq.Ft & Labor)</h4>

    <div id="itemsContainer">
      <div class="row g-2 mb-3 item-row">
        <div class="col-md-5">
          <input type="text" name="items[0][description]" class="form-control form-control-sm rounded-2" required placeholder="e.g. Pressure Jet Wash & Crack Seal Primer Coat (25,000 sq.ft)">
        </div>
        <div class="col-md-2">
          <input type="text" name="items[0][unit]" class="form-control form-control-sm rounded-2" value="sq.ft" required placeholder="Unit">
        </div>
        <div class="col-md-2">
          <input type="number" step="0.01" name="items[0][qty]" class="form-control form-control-sm rounded-2" required placeholder="Qty / Sq.Ft">
        </div>
        <div class="col-md-3">
          <input type="number" step="0.01" name="items[0][rate]" class="form-control form-control-sm rounded-2" required placeholder="Rate (₹ per sq.ft)">
        </div>
      </div>
    </div>

    <div class="row g-2 mb-4">
      <div class="col-md-5">
        <input type="text" name="items[1][description]" class="form-control form-control-sm rounded-2" placeholder="e.g. Asian Paints Apex Ultima Protek 2-Coat Topcoat">
      </div>
      <div class="col-md-2">
        <input type="text" name="items[1][unit]" class="form-control form-control-sm rounded-2" value="sq.ft" placeholder="Unit">
      </div>
      <div class="col-md-2">
        <input type="number" step="0.01" name="items[1][qty]" class="form-control form-control-sm rounded-2" placeholder="Qty / Sq.Ft">
      </div>
      <div class="col-md-3">
        <input type="number" step="0.01" name="items[1][rate]" class="form-control form-control-sm rounded-2" placeholder="Rate (₹ per sq.ft)">
      </div>
    </div>

    <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold text-dark w-100 mt-3">
      <i class="fa-solid fa-calculator me-2"></i> GENERATE OFFICIAL QUOTATION
    </button>
  </form>
</div>
@endsection
