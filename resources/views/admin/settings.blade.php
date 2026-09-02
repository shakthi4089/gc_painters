@extends('layouts.admin')

@section('title', 'Website Settings')
@section('header_title', 'Business & Website Settings')

@section('content')
<div class="bg-white rounded-4 border p-4 shadow-sm max-w-800 mx-auto">
  <h3 class="h5 fw-bold mb-4 border-bottom pb-2">Business Metadata & Contact Info</h3>

  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small">Business Name</label>
        <input type="text" name="business_name" class="form-control rounded-3" value="{{ $settings['business_name'] ?? 'GC Painting & Decorators' }}">
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small">Proprietor Name</label>
        <input type="text" name="owner_name" class="form-control rounded-3" value="{{ $settings['owner_name'] ?? 'G. Chandran & Family' }}">
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold small">Primary Phone</label>
        <input type="text" name="phone" class="form-control rounded-3" value="{{ $settings['phone'] ?? '+91 89250 14875' }}">
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold small">WhatsApp Number (e.g. 919876543210)</label>
        <input type="text" name="whatsapp" class="form-control rounded-3" value="{{ $settings['whatsapp'] ?? '918925014875' }}">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold small">Working Locations</label>
      <input type="text" name="working_locations" class="form-control rounded-3" value="{{ $settings['working_locations'] ?? 'Chennai, Avadi, Ambattur, Velachery, Porur, Tambaram' }}">
    </div>

    <div class="mb-4">
      <label class="form-label fw-bold small">Business Address</label>
      <textarea name="address" class="form-control rounded-3" rows="3">{{ $settings['address'] ?? 'No. 45, Main Road, Anna Nagar / Avadi, Chennai, Tamil Nadu' }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
      <i class="fa-solid fa-floppy-disk me-1"></i> Save Settings
    </button>
  </form>
</div>
@endsection
