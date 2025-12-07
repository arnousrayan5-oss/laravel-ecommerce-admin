<x-adminlayout title="Products">
  <x-slot:header>Products</x-slot:header>
  <x-slot:subheader>Manage your catalog: browse, edit, and add new products.</x-slot:subheader>

  {{-- Flash messages --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Validation errors --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row g-4">
    {{-- Product list --}}
    <div class="col-12 col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">All Products</h5>
          {{-- Optional: add a small search form here later --}}
        </div>

        <div class="card-body">
          @if($products->count())
            <div class="row g-3">
              @foreach($products as $product)
                <div class="col-12 col-md-6">
                  <div class="card h-100 card-hover">
                    <div class="row g-0">
                      <div class="col-4">
                        
                        <div class="ratio ratio-1x1">

                            <img src="/assets/uploads/{{$product->main_image}}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                            
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="card-body">
                          <h6 class="card-title mb-1">{{ $product->name }}</h6>
                          <div class="text-secondary small mb-2">
                            Qty: <span class="fw-semibold">{{ $product->quantity }}</span>
                            &nbsp;•&nbsp;
                            Price: <span class="fw-semibold">{{ number_format($product->price, 2) }}</span>
                          </div>
                          @if(!empty($product->description))
                            <p class="card-text small mb-3 text-secondary">{{ Str::limit($product->description, 100) }}</p>
                          @endif
                          <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            {{-- Pagination (if $products is a paginator) --}}
            @if(method_exists($products, 'links'))
              <div class="mt-3">
                {{ $products->links() }}
              </div>
            @endif
          @else
            <p class="mb-0 text-secondary">No products yet.</p>
          @endif
        </div>
      </div>
    </div>

    {{-- Add product form --}}
    <div class="col-12 col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
          <h5 class="mb-0">Add Product</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.productCreate') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <div class="col-12">
              <label class="form-label">Name</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="col-6">
              <label class="form-label">Quantity</label>
              <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" class="form-control" required>
            </div>

            <div class="col-6">
              <label class="form-label">Price</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01" class="form-control" required>
              </div>
            </div>

            <div class="col-12">
              <label class="form-label">Short Description</label>
              <input type="text" name="description" value="{{ old('description') }}" class="form-control" required>
            </div>

            <div class="col-12">
              <label class="form-label">More Info</label>
              <textarea name="info" rows="4" class="form-control" placeholder="Optional">{{ old('info') }}</textarea>
            </div>

            <div class="col-12">
              <label class="form-label">Main Image</label>
              <input type="file" name="main_image" class="form-control">
            </div>

            <div class="col-12 d-grid">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Product
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-adminlayout>
