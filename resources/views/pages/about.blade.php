@extends('layouts.app')

@section('title', 'About Us — GC Painting & Decorators')

@section('content')
<section class="py-5 bg-dark text-white text-center">
  <div class="container py-4">
    <h1 class="display-5 fw-bold">About GC Painting & Decorators</h1>
    <p class="lead text-light opacity-75 max-w-700 mx-auto">Two Decades of Craftsmanship, Integrity & Quality Execution in Painting Across Chennai.</p>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="text-primary fw-bold text-uppercase tracking-wider small">Our Journey</span>
        <h2 class="display-6 fw-bold mt-1 mb-4">Founded by Master Painter G. Chandran</h2>
        <p class="text-secondary">GC Painting was established over 22 years ago with a single mission: to deliver honest, high-durability painting solutions for homeowners, housing societies, and industrial plants across Tamil Nadu.</p>
        <p class="text-secondary">Unlike casual contractors, we take complete responsibility for surface preparation — repairing cracks, applying anti-fungal primers, and utilizing modern dust-free sanding machines so your family experiences zero discomfort during repainting.</p>
        
        <div class="row g-3 mt-3">
          <div class="col-6">
            <div class="p-3 border rounded-3 bg-light">
              <h4 class="h5 fw-bold text-primary mb-1">350+ Projects</h4>
              <small class="text-secondary">Apartments, Villas & Commercial</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 border rounded-3 bg-light">
              <h4 class="h5 fw-bold text-success mb-1">5-Year Warranty</h4>
              <small class="text-secondary">On Weather-Shield Exterior Work</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="p-4 bg-light rounded-4 border shadow-sm">
          <h3 class="h4 fw-bold mb-4">Our 5-Step Execution Process</h3>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">1</div>
            <div>
              <h5 class="fw-bold mb-1">Enquiry & On-Site Measurement</h5>
              <p class="text-secondary small mb-0">We inspect your property walls, test moisture levels, and take precise sq.ft measurements.</p>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">2</div>
            <div>
              <h5 class="fw-bold mb-1">Itemized Transparent Estimate</h5>
              <p class="text-secondary small mb-0">Clear line-item quotation covering primer coats, paint brands, labor rates, and project schedule.</p>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">3</div>
            <div>
              <h5 class="fw-bold mb-1">Surface Scrubbing & Protection</h5>
              <p class="text-secondary small mb-0">Pressure washing exterior moss, mask doors/windows, and cover furniture with protective sheets.</p>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">4</div>
            <div>
              <h5 class="fw-bold mb-1">Multi-Coat Application</h5>
              <p class="text-secondary small mb-0">Dual primer coats, putty smoothing, and two full topcoats of Asian Paints / Dulux.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <div class="rounded-circle bg-success text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">5</div>
            <div>
              <h5 class="fw-bold mb-1">Final Inspection & Handover</h5>
              <p class="text-secondary small mb-0">Deep cleanup, touchup check with client, and handover of 5-year warranty certificate.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
