<x-adminlayout title="Admin Panel">
  <x-slot:header>Welcome, Admin</x-slot:header>
  <x-slot:subheader>Quick actions to manage users, media, tags, and products.</x-slot:subheader>

  <div class="row g-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-hover h-100">
        <div class="card-body">
          <i class="bi bi-people fs-3 text-primary"></i>
          <h5 class="card-title mt-2">User Management</h5>
          <p class="card-text text-secondary">Create, edit, and manage users.</p>
          <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">Open</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-hover h-100">
        <div class="card-body">
          <i class="bi bi-images fs-3 text-primary"></i>
          <h5 class="card-title mt-2">Carousel</h5>
          <p class="card-text text-secondary">Manage homepage slides.</p>
          <a href="{{ route('admin.carousel') }}" class="btn btn-primary btn-sm">Open</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-hover h-100">
        <div class="card-body">
          <i class="bi bi-tags fs-3 text-primary"></i>
          <h5 class="card-title mt-2">Tags</h5>
          <p class="card-text text-secondary">Organize tags for products.</p>
          <a href="{{ route('admin.tags') }}" class="btn btn-primary btn-sm">Open</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-hover h-100">
        <div class="card-body">
          <i class="bi bi-box-seam fs-3 text-primary"></i>
          <h5 class="card-title mt-2">Products</h5>
          <p class="card-text text-secondary">Manage product inventory.</p>
          <a href="{{ route('admin.products') }}" class="btn btn-primary btn-sm">Open</a>
        </div>
      </div>
    </div>
  </div>
</x-adminlayout>
