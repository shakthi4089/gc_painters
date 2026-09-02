<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') — GC Painting Management</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light admin-body">

  <div class="admin-wrapper">
    <!-- Admin Sidebar -->
    <div class="admin-sidebar d-flex flex-column justify-content-between p-3">
      <div>
        <div class="sticky-top py-2 px-2 mb-3 border-bottom border-secondary border-opacity-25" style="top: 0; background-color: #0f172a !important; z-index: 5;">
          <div class="d-flex align-items-center gap-2">
            <span class="brand-badge fs-6"><i class="fa-solid fa-paint-roller me-1"></i>GC</span>
            <div>
              <div class="fw-bold text-white fs-6">GC PAINTING</div>
              <small class="d-block fw-bold fs-8" style="color: #38bdf8 !important; letter-spacing: 0.8px;">ADMIN PANEL</small>
            </div>
          </div>
        </div>

        <nav class="d-flex flex-column gap-1">
          <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
          </a>
          <a href="{{ route('admin.enquiries') }}" class="sidebar-link {{ request()->routeIs('admin.enquiries') ? 'active' : '' }}">
            <i class="fa-solid fa-inbox"></i> Enquiries
          </a>
          <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
            <i class="fa-solid fa-list-check"></i> Project Management
          </a>
          <a href="{{ route('admin.quotations.index') }}" class="sidebar-link {{ request()->routeIs('admin.quotations*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar"></i> Quotations
          </a>
          <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i> Website Settings
          </a>
          <hr class="border-secondary border-opacity-25 my-2">
          <a href="{{ route('customer.dashboard') }}" class="sidebar-link" target="_blank">
            <i class="fa-solid fa-user"></i> Customer Portal
          </a>
          <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fa-solid fa-globe"></i> View Website
          </a>
        </nav>
      </div>

      <div class="px-2 pb-2">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger w-100 rounded-3 text-start small fw-bold">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
          </button>
        </form>
      </div>
    </div>

    <!-- Main Workspace Content -->
    <div class="admin-main-workspace">
      <!-- Top Bar -->
      <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center sticky-top" style="z-index: 10; top: 0;">
        <div>
          <h2 class="h5 fw-bold mb-0 text-dark">@yield('header_title', 'Admin Dashboard')</h2>
          <small class="text-secondary">Welcome back, Chandran! System status normal.</small>
        </div>
        <div class="d-flex align-items-center gap-3">
          <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-pill btn-sm px-3 fw-bold">
            <i class="fa-solid fa-plus me-1"></i> New Project
          </a>
          <a href="{{ route('admin.quotations.create') }}" class="btn btn-warning rounded-pill btn-sm px-3 fw-bold text-dark">
            <i class="fa-solid fa-calculator me-1"></i> New Quote
          </a>
        </div>
      </header>

      <!-- Main Body Container -->
      <div class="p-4 flex-grow-1">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @yield('content')
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
