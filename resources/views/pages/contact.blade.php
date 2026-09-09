@extends('layouts.app')

@section('title', 'Contact Us — GC Painting & Decorators')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">Contact GC Painting & Decorators</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Get in touch directly with Master Painter G. Chandran for site visits, estimates, or project consultations.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border h-100">
          <h2 class="h4 fw-bold mb-4 text-primary">Get In Touch</h2>

          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
              <i class="fa-solid fa-location-dot fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-1 fs-6">Main Service Hubs / Address</h5>
              <p class="text-secondary mb-0">{{ config('custom-app.contact.address') }}</p>
            </div>
          </div>

          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
              <i class="fa-solid fa-phone fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-1 fs-6">Phone & Mobile</h5>
              <p class="text-secondary mb-0">{{ config('custom-app.contact.phone_display') }}</p>
            </div>
          </div>

          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
              <i class="fa-solid fa-envelope fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-1 fs-6">Email Address</h5>
              <p class="text-secondary mb-0">{{ config('custom-app.contact.email') }}</p>
            </div>
          </div>

          <div class="d-flex gap-3">
            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
              <i class="fa-brands fa-whatsapp fs-4"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-1 fs-6">WhatsApp Support</h5>
              <a href="https://api.whatsapp.com/send/?phone={{ config('custom-app.contact.whatsapp_number') }}&text={{ urlencode(config('custom-app.contact.whatsapp_default_message')) }}" target="_blank" class="text-success fw-bold text-decoration-none">{{ config('custom-app.contact.phone_display') }} (Chat Now)</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border">
          <h2 class="h4 fw-bold mb-4">Send Us a Direct Message</h2>
          
          <form action="{{ route('quote.submit') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold small">Name *</label>
                <input type="text" name="name" class="form-control rounded-3" required placeholder="Your Name">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Phone Number *</label>
                <input type="tel" name="phone" class="form-control rounded-3" required placeholder="Your Phone Number">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold small">Location *</label>
              <input type="text" name="location" class="form-control rounded-3" required placeholder="e.g. Ambattur / Velachery">
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold small">Message / Inquiry Details</label>
              <textarea name="additional_requirements" class="form-control rounded-3" rows="5" required placeholder="How can we help you with your painting project?"></textarea>
            </div>

            <input type="hidden" name="property_type" value="General Enquiry">
            <input type="hidden" name="painting_type" value="Both">

            <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">
              <i class="fa-solid fa-paper-plane me-2"></i> Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
