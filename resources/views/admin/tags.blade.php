<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tags</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
        }
        .hero-banner {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6); /* Blue gradient */
            border-radius: 1.5rem;
            color: #fff;
            padding: 2.5rem 2rem;
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
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-2">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="{{ route('admin.users') }}">
                        Users
                    </a>
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

    <!-- BLUE HEADER -->
    <section class="hero-banner mb-4">
        <h1 class="h2 mb-2">Tags</h1>
        <p class="mb-0">View all tags and the products linked to each one.</p>
    </section>

    <!-- TAGS LIST CARD -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Tag List</h2>
            <small class="text-muted">Tags and associated products</small>
        </div>

        <div class="card-body">

            @if($tags->isEmpty())
                <p class="text-muted">No tags available.</p>
            @else
                <ul class="list-group">
                    @foreach($tags as $tag)
                        <li class="list-group-item">
                            <strong class="text-primary">{{ $tag->name }}</strong>

                            <div class="mt-2 ms-3">
                                @if($tag->products->isEmpty())
                                    <p class="text-muted small">No products under this tag.</p>
                                @else
                                    <ul class="small">
                                        @foreach($tag->products as $product)
                                            <li>{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>

    <!-- TAG CREATION CARD -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Add New Tag</h2>
            <small class="text-muted">Create a new tag for categorizing products.</small>
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

            <!-- FORM -->
            <form action="{{ route('admin.tagCreate') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-12">
                    <label class="form-label">Tag Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter tag name" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">
                        Add Tag
                    </button>
                </div>

            </form>

        </div>

        <div class="card-footer bg-white text-muted small text-center">
            © 2025 Admin Panel · Built with Bootstrap 5
        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
