@extends('layouts.app')

@section('title', 'Login — GC Painting Portal')

@section('content')
<section class="py-5 bg-light min-vh-75 d-flex align-items-center">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow border">
          <div class="text-center mb-4">
            <span class="brand-badge fs-4 mb-2 d-inline-block"><i class="fa-solid fa-paint-roller me-1"></i>GC</span>
            <h1 class="h4 fw-bold text-dark mb-1">Account Login</h1>
            <p class="text-secondary small mb-0">Sign in to access Admin Panel or Customer Project Tracker</p>
          </div>

          @if($errors->any())
            <div class="alert alert-danger rounded-3 small mb-4">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label class="form-label fw-bold small">Email Address</label>
              <input type="email" name="email" id="emailInput" class="form-control rounded-3" required placeholder="admin@gcprojects.com">
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold small">Password</label>
              <input type="password" name="password" id="passwordInput" class="form-control rounded-3" value="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100 fw-bold py-2 mb-3">
              <i class="fa-solid fa-right-to-bracket me-2"></i> Log In
            </button>
          </form>

          <!-- Quick Test Credentials Buttons -->
          <div class="p-3 bg-light rounded-3 border text-center mt-3">
            <div class="text-uppercase text-muted fw-bold fs-8 mb-2">Quick Test Logins</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-sm btn-outline-dark flex-fill rounded-pill fw-semibold" onclick="document.getElementById('emailInput').value='admin@gcprojects.com';">
                <i class="fa-solid fa-user-gear me-1"></i> Admin Login
              </button>
              <button type="button" class="btn btn-sm btn-outline-success flex-fill rounded-pill fw-semibold" onclick="document.getElementById('emailInput').value='ramesh@example.com';">
                <i class="fa-solid fa-user me-1"></i> Customer Login
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
