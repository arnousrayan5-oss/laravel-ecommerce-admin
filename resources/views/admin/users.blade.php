<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
        }
        .hero-banner {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6); /* blue → purple */
            border-radius: 1.5rem;
            color: #fff;
            padding: 2.5rem 2rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR (same as all admin pages) -->
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
                    <a class="nav-link active d-flex align-items-center gap-1" href="{{ route('admin.users') }}">
                        <i class="bi bi-people"></i> Users
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

    <!-- BLUE HEADER -->
    <section class="hero-banner mb-4">
        <h1 class="h2 mb-2">Active Users</h1>
        <p class="mb-0">View all active system users and manage their roles.</p>
    </section>

    <!-- USERS TABLE CARD -->
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <div>
                <h2 class="h5 mb-0">Users List</h2>
                <small class="text-muted">Manage user roles and delete accounts.</small>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.deletedUsers') }}" class="btn btn-outline-danger">
                    Deleted Users
                </a>
                <a href="{{ route('admin.allUsers') }}" class="btn btn-primary">
                    All Users
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="width:120px;">Role</th>
                        <th style="width:250px;">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
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
                                <div class="d-flex flex-wrap gap-2">

                                    <!-- Toggle Role -->
                                    <form action="{{ route('admin.toggleRole', $user->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            {{ $user->role === 'admin' ? 'Make User' : 'Make Admin' }}
                                        </button>
                                    </form>

                                    <!-- Delete User -->
                                    <form action="{{ route('admin.deleteUser', $user->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>

                                </div>
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

        <div class="card-footer bg-white text-muted small text-center">
            © 2025 Admin Panel · Built with Bootstrap 5
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
