<ul class="navbar-nav gap-2">

  <li class="nav-item">
    <a
      href="{{ route('admin.products.index') }}"
      class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
      Products
    </a>
  </li>

  <li class="nav-item">
    <a
      href="{{ route('admin.articles.index') }}"
      class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
      Articles
    </a>
  </li>

</ul>