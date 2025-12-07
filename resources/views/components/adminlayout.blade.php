<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: var(--bs-body-bg); color: var(--bs-body-color); transition: background-color .3s, color .3s; }
    .hero { background: linear-gradient(135deg, #0d6efd, #6610f2); color: #fff; border-radius: 1rem; }
    .card-hover:hover { transform: translateY(-2px); box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15); }
    .dark-mode {
      --bs-body-bg:#121212; --bs-body-color:#f1f1f1; --bs-card-bg:#1e1e1e; --bs-card-color:#f1f1f1;
    }
  </style>
  @stack('head')
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top px-3" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="{{ url('/admin') }}">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="adminNav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}"><i class="bi bi-people me-1"></i>Users</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.carousel') }}"><i class="bi bi-images me-1"></i>Carousel</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.tags') }}"><i class="bi bi-tags me-1"></i>Tags</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}"><i class="bi bi-box-seam me-1"></i>Products</a></li>
          <li class="nav-item">
            <button class="btn btn-outline-secondary ms-lg-2" id="themeToggle"><i class="bi bi-moon"></i> Dark Mode</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @if (isset($header) || isset($subheader))
    <header class="container my-4">
      <div class="p-4 p-md-5 hero">
        @isset($header)
          <h1 class="display-6 fw-semibold mb-2">{{ $header }}</h1>
        @else
          <h1 class="display-6 fw-semibold mb-2">{{ $title }}</h1>
        @endisset
        @isset($subheader)
          <p class="mb-0 opacity-75">{{ $subheader }}</p>
        @endisset
      </div>
    </header>
  @endif

  <main class="container pb-5">
    {{ $slot }}
  </main>

  <footer class="border-top py-4 text-center small text-secondary">
    &copy; {{ date('Y') }} Admin Panel • Built with Bootstrap 5
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;
    const navbar = document.getElementById('navbar');
    if (localStorage.getItem('theme') === 'dark') {
      body.classList.add('dark-mode');
      navbar.classList.remove('bg-white'); navbar.classList.add('bg-dark');
      toggleBtn.innerHTML = '<i class="bi bi-brightness-high"></i> Light Mode';
    }
    toggleBtn.addEventListener('click', () => {
      body.classList.toggle('dark-mode');
      const dark = body.classList.contains('dark-mode');
      navbar.classList.toggle('bg-dark', dark);
      navbar.classList.toggle('bg-white', !dark);
      toggleBtn.innerHTML = dark ? '<i class="bi bi-brightness-high"></i> Light Mode' : '<i class="bi bi-moon"></i> Dark Mode';
      localStorage.setItem('theme', dark ? 'dark' : 'light');
    });
  </script>
  @stack('scripts')
</body>
</html>
