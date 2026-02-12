<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LMS Admin')</title>

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d9e1e3 0%, #f0fff4 100%);
            min-height: 100vh;
        }

        /* Light Mint Green Navbar */
        .navbar-mint-green {
            background: linear-gradient(135deg, #a7f3d0 0%, #86efac 50%, #bbf7d0 100%);
            box-shadow: 0 8px 32px rgba(186, 224, 60, 0.4);
            border-bottom: 1px solid rgba(37, 161, 202, 0.6);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #c52fe3, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-text {
            background: linear-gradient(135deg, #2438e8, #dd76eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
            font-size: 2.1rem;
        }

        /* Light Green Sidebar */
        .sidebar {
            width: 300px;
            background: linear-gradient(180deg, #86ef2b 0%, #41c5e2 50%, #f0fdf4 100%);
            box-shadow: 8px 0 40px rgba(7, 7, 7, 0.4);
            border-right: 2px solid rgba(49, 216, 20, 0.6);
            backdrop-filter: blur(12px);
            z-index: 1000;
        }

        .sidebar h6 {
            background: linear-gradient(90deg, #a7f3d0, #86efac);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            padding-top: 5.5rem;
            border-bottom: 2px solid rgba(0, 16, 8, 0.5);
            letter-spacing: 1px;
            text-align: center;
        }

        .nav-link {
            color: #05070f !important;
            font-weight: 500;
            padding: 14px 24px;
            border-radius: 16px;
            margin-bottom: 10px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #2e5c46 0%, #b6cdbe 100%);
            color: #8fe7ce !important;
            transform: translateX(12px) scale(1.02);
            box-shadow: 0 8px 25px rgba(167, 243, 208, 0.5);
            border-color: rgba(134, 239, 172, 0.7);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white !important;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            border-color: rgba(75, 185, 16, 0.6);
        }

        .nav-link i {
            margin-right: 14px;
            width: 22px;
        }

        /* Main content */
        .main-content {
            margin-left: 300px;
            padding: 6rem 2rem 2rem 2rem;
            min-height: 100vh;
            width: calc(100% - 300px);
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-mint-green fixed-top py-3">
        <div class="container-fluid px-4">
            <span class="navbar-brand mb-0">📚 Library Management System</span>
            <span class="navbar-text ms-auto">👨‍💼 Admin Panel</span>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar position-fixed h-100 p-4" id="sidebar">
            <h6>🏠🏠🏠🏠🏠🏠🏠🏠🏠</h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-heart"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}"
                        href="{{ route('admin.books.index') }}">
                        <i class="bi bi-book-half"></i>Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people-fill"></i>Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.transactions.issue') ? 'active' : '' }}"
                        href="{{ route('admin.transactions.issue') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>Issue Book
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.transactions.return') ? 'active' : '' }}"
                        href="{{ route('admin.transactions.return') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>Return Book
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reservations.index') ? 'active' : '' }}"
                        href="{{ route('admin.reservations.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>Reservation Book
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                        @csrf
                    </form>
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>