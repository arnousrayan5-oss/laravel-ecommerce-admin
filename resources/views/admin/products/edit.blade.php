<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
        }
        .hero-banner {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6); /* blue gradient */
            border-radius: 1.5rem;
            color: #fff;
            padding: 2.5rem 2rem;
        }
        .image-thumb {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 3px;
            background: #fff;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid px-4">

        <a class="navbar-brand fw-bold" href="#">
            Admin Panel
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-2">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                </li>

                <li class="nav-item">
                    <span class="btn btn-outline-secondary btn-sm rounded-pill">
                        Dark Mode
                    </span>
                </li>

            </ul>
        </div>

    </div>
</nav>

<main class="container my-4">

    <!-- PAGE HEADER -->
    <section class="hero-banner mb-4">
        <h1 class="h2 mb-2">Edit Product</h1>
        <p class="mb-0">Modify product details, manage tags, and upload images.</p>
    </section>

    <!-- EDIT PRODUCT CARD -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Product Information</h2>
            <small class="text-muted">Update the main product fields.</small>
        </div>

        <div class="card-body">

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.productEditAction', $product->id) }}" 
                  method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                           value="{{ old('quantity', $product->quantity) }}" min="0" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" name="price" class="form-control"
                           value="{{ old('price', $product->price) }}" min="0" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Short Description</label>
                    <input type="text" name="description" class="form-control"
                           value="{{ old('description', $product->description) }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Detailed Information</label>
                    <textarea name="info" class="form-control" rows="4">{{ old('info', $product->info) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="main_image" class="form-control">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <img src="/assets/uploads/{{ $product->main_image }}"
                         width="120" class="image-thumb">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- TAG MANAGEMENT -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Product Tags</h2>
            <small class="text-muted">Add or remove tags from this product.</small>
        </div>

        <div class="card-body">

            <!-- Add Tag -->
            <form action="{{ route('admin.productAddTag', $product->id) }}" method="POST" class="row g-3 mb-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Select Tag</label>
                    <select name="tag" class="form-select">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary w-100">Add Tag</button>
                </div>
            </form>

            <!-- Existing Tags -->
            <ul class="list-group">
                @forelse($product->tags as $tag)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $tag->name }}</span>

                        <form action="{{ route('admin.productRemoveTag', [$product->id, $tag->id]) }}" 
                              method="POST">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">Remove</button>
                        </form>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Product doesn't have tags</li>
                @endforelse
            </ul>

        </div>
    </div>

    <!-- PRODUCT IMAGES -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Product Images</h2>
            <small class="text-muted">Upload additional photos.</small>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.productUploadImage', $product->id) }}" 
                  method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
                @csrf

                <div class="col-md-8">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Add Image</button>
                </div>
            </form>

            <!-- Existing Images -->
            <div class="d-flex flex-wrap gap-3">
                @forelse ($product->images as $image)
                    <img src="/assets/uploads/{{ $image->image }}"
                         width="120" class="image-thumb">
                @empty
                    <p class="text-muted">Product has no images</p>
                @endforelse
            </div>

        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
