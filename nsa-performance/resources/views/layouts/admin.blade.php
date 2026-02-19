<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>NSA Performance - Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Lexend:wght@100..900&display=swap" rel="stylesheet">

  <style>
    .admin-navbar {
      background-color: #000;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .admin-navbar .nav-link {
      color: #bbb;
      font-weight: 500;
      padding: 0.75rem 1.25rem;
    }

    .admin-navbar .nav-link:hover,
    .admin-navbar .nav-link.active {
      color: #ff4d4d;
    }
  </style>
</head>

<body class="bg-white text-black">

  <!-- Top Navbar -->
  <nav class="navbar admin-navbar navbar-expand-lg">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center gap-3" href="/">
        <img width="100" src="{{ asset('assets/images/logo/logo-nsa.png') }}" alt="NSA Performance Logo" class="navbar-logo">
      </a>
      <a class="navbar-brand text-white fw-bold" href="{{ route('admin.products.index') }}">
        ADMIN DASHBOARD
      </a>

      <!-- Mobile toggle -->
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Centered Menu -->
      <div class="collapse navbar-collapse justify-content-center" id="adminNavbar">
        @include('layouts.admin-nav')
      </div>

      <!-- Right actions -->
      <div class="d-none d-lg-flex">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-sm btn-outline-light">
            Logout
          </button>
        </form>
      </div>

    </div>
  </nav>

  <!-- Main Content -->
  <main class="container py-4">
    @yield('content')
  </main>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')
</body>

</html>