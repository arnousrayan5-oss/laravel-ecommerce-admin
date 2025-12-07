<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
        }
        .hero-banner {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            border-radius: 1.5rem;
            color: #fff;
            padding: 2.5rem 2rem;
        }
    </style>
</head>
<body>

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
                    <a class="nav-link active d-flex align-items-center gap-1" href="#">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="#">
                        <i class="bi bi-images"></i> Carousel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="#">
                        <i class="bi bi-tags"></i> Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="#">
                        <i class="bi bi-box-seam"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill">
                        Dark Mode
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-4">

    <!-- Gradient header -->
    <section class="hero-banner mb-4">
        <h1 class="h2 mb-2">Users</h1>
        <p class="mb-0">Create, edit, and manage all users in the system.</p>
    </section>

    <!-- Users card -->
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <div>
                <h2 class="h5 mb-0">All Users</h2>
                <small class="text-muted">List of all users including deleted accounts.</small>
            </div>
            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                Active Users
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 60px;">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 120px;">Role</th>
                        <th scope="col" style="width: 260px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="{{ $user->deleted_at ? 'table-danger' : '' }}">
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                            <td>
                                @if($user->deleted_at)
                                    <div class="d-flex flex-wrap gap-2">
                                        <form action="{{ route('admin.restoreUser', $user->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Restore
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.forceDeleteUser', $user->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Force Delete
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="d-flex flex-wrap gap-2">
                                        <form action="{{ route('admin.toggleRole', $user->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                {{ $user->role == 'admin' ? 'Make User' : 'Make Admin' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.deleteUser', $user->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No users found.
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-muted small text-center bg-white">
            © 2025 Admin Panel · Built with Bootstrap 5
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
