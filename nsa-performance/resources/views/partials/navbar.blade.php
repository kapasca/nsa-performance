@push('styles')
<style>
  body {
    background-color: #000000;
    color: #ffffff;
  }

  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    min-height: 120px;
    background: rgba(0, 0, 0, 0.6);
    transition: 1s ease;
  }

  .navbar-logo {
    height: 100px;
    width: auto;
  }

  .nav-link:hover,
  .nav-link:focus,
  .nav-link.active {
    color: #ff4d4d !important;
  }

  .navbar-solid {
    background: rgba(0, 0, 0, 0.95);
    transition: 1s ease;
  }

  .search-input {
    background-color: rgba(255, 255, 255, 0.1) !important;
    border: none;
    border-radius: 25px;
    padding-left: 40px;
    color: #ffffff;
    transition: background-color 0.3s ease;
  }

  .search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
  }

  .search-input:focus {
    background-color: rgba(255, 255, 255, 0.15) !important;
    box-shadow: none !important;
    outline: none !important;
    color: #ffffff;
  }

  @media (max-width: 991px) {
    .navbar {
      min-height: 100px;
      background-color: #000000;
    }

    .navbar-collapse {
      padding: 20px 30px 35px 30px;
      background: rgba(0, 0, 0, 0.75);
      border-radius: 15px;
    }

    .navbar-nav {
      margin-bottom: 15px;
      margin-top: 10px;
      margin-left: 15px !important;
    }
  }

  @media (max-width: 768px) {
    .navbar {
      min-height: 80px;
      /* background: rgba(0, 0, 0, 0); */
    }
  }
</style>
@endpush

<nav class="navbar navbar-expand-lg navbar-dark navbar-overlay py-2">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center gap-3" href="#">
      <img
        src="{{ asset('assets/images/logo/logo-nsa.png') }}"
        alt="NSA Performance Logo"
        class="navbar-logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto me-4 gap-2">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#articles">Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="#videos">Videos</a></li>
      </ul>

      <form class="d-flex mb-0" id="searchForm">
        <div class="position-relative">
          <input
            class="form-control form-control-sm search-input"
            type="search"
            placeholder="Search"
            id="searchInput">
          <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9c9c9c; pointer-events: none;"></i>
        </div>
      </form>

      <!-- Check if user is authenticated -->
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-link text-decoration-none bg-danger text-white ms-4">
            Logout
          </button>
        </form>
      @endauth

    </div>

  </div>
</nav>

@push('scripts')
<script>
  $(function() {
    const $navbar = $('.navbar');
    const $searchInput = $('#searchInput');

    function handleNavbarScroll() {
      if (window.innerWidth <= 991) {
        $navbar.addClass('navbar-solid');
        return;
      }

      if ($(window).scrollTop() > 400) {
        $navbar.addClass('navbar-solid');
      } else {
        $navbar.removeClass('navbar-solid');
      }
    }

    handleNavbarScroll();
    $(window).on('scroll resize', handleNavbarScroll);

    $searchInput.on('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        const keyword = $(this).val().trim();
        console.log('Search keyword:', keyword);
      }
    });
  });
</script>
@endpush