@extends('layouts.app')

@section('title', 'Request a Free Quote — GC Painting & Decorators')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">Request a Free On-Site Quote</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Fill in your property details below. Our team will inspect your site, provide color advice, and deliver a transparent estimate.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow border">
          <h2 class="h4 fw-bold mb-4 text-primary d-flex align-items-center gap-2">
            <i class="fa-solid fa-calculator"></i> Property & Painting Quote Form
          </h2>

          <form action="{{ route('quote.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Personal Info -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label fw-bold small">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-lg rounded-3 fs-6" required placeholder="e.g. Ramesh Kumar">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Phone Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control form-control-lg rounded-3 fs-6" required placeholder="e.g. 9840123456">
              </div>
              <div class="col-12">
                <label class="form-label fw-bold small">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg rounded-3 fs-6" placeholder="e.g. ramesh@example.com">
              </div>
            </div>

            <!-- Property Type Radio/Select -->
            <div class="mb-4">
              <label class="form-label fw-bold small mb-2">Property Type <span class="text-danger">*</span></label>
              <div class="row g-3">
                <div class="col-6 col-md-3">
                  <input type="radio" class="btn-check" name="property_type" id="type_house" value="House" checked>
                  <label class="btn btn-outline-primary w-100 py-3 rounded-3 text-center fw-semibold" for="type_house">
                    <i class="fa-solid fa-house fs-4 d-block mb-1"></i> House
                  </label>
                </div>
                <div class="col-6 col-md-3">
                  <input type="radio" class="btn-check" name="property_type" id="type_apt" value="Apartment">
                  <label class="btn btn-outline-primary w-100 py-3 rounded-3 text-center fw-semibold" for="type_apt">
                    <i class="fa-solid fa-building fs-4 d-block mb-1"></i> Apartment
                  </label>
                </div>
                <div class="col-6 col-md-3">
                  <input type="radio" class="btn-check" name="property_type" id="type_comm" value="Commercial">
                  <label class="btn btn-outline-primary w-100 py-3 rounded-3 text-center fw-semibold" for="type_comm">
                    <i class="fa-solid fa-briefcase fs-4 d-block mb-1"></i> Commercial
                  </label>
                </div>
                <div class="col-6 col-md-3">
                  <input type="radio" class="btn-check" name="property_type" id="type_ind" value="Industrial">
                  <label class="btn btn-outline-primary w-100 py-3 rounded-3 text-center fw-semibold" for="type_ind">
                    <i class="fa-solid fa-industry fs-4 d-block mb-1"></i> Industrial
                  </label>
                </div>
              </div>
            </div>

            <!-- Location & Painting Type -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label fw-bold small">Location / Area <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control form-control-lg rounded-3 fs-6" required placeholder="e.g. Anna Nagar / Avadi, Chennai">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold small">Painting Type <span class="text-danger">*</span></label>
                <select name="painting_type" class="form-select form-select-lg rounded-3 fs-6" required>
                  <option value="Interior">Interior Painting Only</option>
                  <option value="Exterior">Exterior Painting Only</option>
                  <option value="Both" selected>Both Interior & Exterior</option>
                  <option value="Epoxy Flooring">Epoxy Floor Coating</option>
                  <option value="Texture Wall">Royale Metallic Texture Wall</option>
                </select>
              </div>
            </div>

            <!-- Area, Floors, Preferred Date -->
            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <label class="form-label fw-bold small">Approximate Area (sq.ft)</label>
                <input type="text" name="approx_area" class="form-control rounded-3" placeholder="e.g. 2,500 sq.ft">
              </div>

              <div class="col-md-4">
                <label class="form-label fw-bold small">Number of Floors</label>
                <input type="text" name="floors" class="form-control rounded-3" placeholder="e.g. 2 Floors / G+2">
              </div>

              <div class="col-md-4">
                <label class="form-label fw-bold small">Preferred Start Date</label>
                <input type="date" name="preferred_start_date" class="form-control rounded-3">
              </div>
            </div>

            <!-- Upload Photos -->
            <div class="mb-4">
              <label class="form-label fw-bold small">Upload Photos (Optional)</label>
              <input type="file" name="photos[]" multiple class="form-control rounded-3" accept="image/*">
              <small class="text-secondary">Upload photos of current wall condition for faster accurate estimates.</small>
            </div>

            <!-- Additional Requirements -->
            <div class="mb-4">
              <label class="form-label fw-bold small">Additional Requirements / Notes</label>
              <textarea name="additional_requirements" class="form-control rounded-3" rows="4" placeholder="Mention any specific color preferences, water seepage issues, or timeline constraints..."></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-warning btn-lg rounded-pill w-100 fw-bold py-3 text-dark shadow-sm">
              <i class="fa-solid fa-paper-plane me-2"></i> REQUEST QUOTE NOW
            </button>
          </form>

          <div class="text-center mt-4 pt-3 border-top">
            <span class="text-secondary small">Prefer direct messaging?</span>
            <a href="https://wa.me/918925014875?text=Hi%20GC%20Painting!%20I%20want%20to%20request%20a%20quote." target="_blank" class="text-success fw-bold ms-2 text-decoration-none">
              <i class="fa-brands fa-whatsapp me-1"></i> Get a Quote on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
