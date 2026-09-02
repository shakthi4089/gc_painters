@extends('layouts.admin')

@section('title', 'Quotation: ' . $quotation->quotation_number)
@section('header_title', 'Estimate / Quotation Document')

@section('content')
<div class="bg-white rounded-4 border p-4 p-md-5 shadow-sm max-w-900 mx-auto" id="printableQuote">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-4">
    <div>
      <span class="brand-badge fs-5 me-2"><i class="fa-solid fa-paint-roller me-1"></i>GC</span>
      <span class="fw-bold fs-4 text-dark">GC PAINTING & DECORATORS</span>
      <div class="text-secondary small mt-1">Anna Nagar & Avadi, Chennai, Tamil Nadu &bull; Phone: +91 89250 14875</div>
    </div>
    <div class="text-end">
      <h2 class="h4 fw-extrabold text-primary mb-1">QUOTATION</h2>
      <div class="badge bg-light text-dark border fs-6">{{ $quotation->quotation_number }}</div>
      <div class="text-secondary small mt-1">Date: {{ $quotation->quote_date ? $quotation->quote_date->format('M d, Y') : date('M d, Y') }}</div>
    </div>
  </div>

  <div class="row g-4 mb-4 p-3 bg-light rounded-3 border">
    <div class="col-6">
      <small class="text-uppercase text-muted fw-bold">Customer Details</small>
      <h5 class="fw-bold text-dark mb-1 fs-6 mt-1">{{ $quotation->customer_name }}</h5>
      <div class="text-secondary small"><i class="fa-solid fa-phone me-1 text-primary"></i> {{ $quotation->customer_phone }}</div>
      <div class="text-secondary small"><i class="fa-solid fa-location-dot me-1 text-danger"></i> {{ $quotation->property_location }}</div>
    </div>
    <div class="col-6 text-end">
      <small class="text-uppercase text-muted fw-bold">Contractor Details</small>
      <h5 class="fw-bold text-dark mb-1 fs-6 mt-1">G. Chandran (Proprietor)</h5>
      <div class="text-secondary small">Email: contact@gcpainting.com</div>
      <div class="text-secondary small">GSTIN / Reg: 33ABCDE1234F1Z5</div>
    </div>
  </div>

  <table class="table table-bordered align-middle mb-4">
    <thead class="table-dark small text-uppercase">
      <tr>
        <th>#</th>
        <th>Item & Work Description</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Qty</th>
        <th class="text-end">Rate (₹)</th>
        <th class="text-end">Total (₹)</th>
      </tr>
    </thead>
    <tbody class="small">
      @foreach($quotation->items as $idx => $item)
        <tr>
          <td>{{ $idx + 1 }}</td>
          <td><strong class="text-dark">{{ $item->item_description }}</strong></td>
          <td class="text-center">{{ $item->quantity_unit }}</td>
          <td class="text-center">{{ number_format($item->quantity, 0) }}</td>
          <td class="text-end">₹{{ number_format($item->unit_rate, 2) }}</td>
          <td class="text-end fw-bold">₹{{ number_format($item->total_price, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot class="table-light">
      <tr>
        <td colspan="5" class="text-end fw-bold">Subtotal:</td>
        <td class="text-end fw-bold">₹{{ number_format($quotation->subtotal, 2) }}</td>
      </tr>
      <tr>
        <td colspan="5" class="text-end text-muted">Estimated Tax (5% GST):</td>
        <td class="text-end text-muted">₹{{ number_format($quotation->tax_amount, 2) }}</td>
      </tr>
      <tr>
        <td colspan="5" class="text-end fw-extrabold text-primary fs-5">Grand Total:</td>
        <td class="text-end fw-extrabold text-primary fs-5">₹{{ number_format($quotation->total_amount, 2) }}</td>
      </tr>
    </tfoot>
  </table>

  @if($quotation->terms_and_conditions)
    <div class="p-3 bg-light rounded-3 border mb-4">
      <h6 class="fw-bold text-dark mb-2">Terms & Conditions</h6>
      <p class="small text-secondary mb-0" style="white-space: pre-line;">{{ $quotation->terms_and_conditions }}</p>
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center border-top pt-4">
    <button onclick="window.print()" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
      <i class="fa-solid fa-print me-1"></i> Print / Download PDF
    </button>
    <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $quotation->customer_phone) }}?text=Hello%20{{ urlencode($quotation->customer_name) }}!%20Here%20is%20your%20Quotation%20{{ $quotation->quotation_number }}%20for%20total%20Amount%20Rs.{{ number_format($quotation->total_amount,2) }}" target="_blank" class="btn btn-success rounded-pill px-4 fw-bold">
      <i class="fa-brands fa-whatsapp me-1"></i> Send Quote on WhatsApp
    </a>
  </div>
</div>
@endsection
