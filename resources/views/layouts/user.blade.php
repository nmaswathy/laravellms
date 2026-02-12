<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LMS User')</title>

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-dark bg-primary mb-4 p-3">
        <div class="container">
            <span class="navbar-brand mb-0 h1">📚 Library User Panel</span>
            <div class="ms-auto d-flex align-items-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm me-2">Home</a>
                <a href="{{ route('user.reservations.create') }}" class="btn btn-outline-light btn-sm me-2">Reserve
                    Books</a>
                <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-light btn-sm me-2">View Reserve
                    Books</a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                    @csrf
                </form>
                <a href="#" class="btn btn-outline-light btn-sm"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>