@extends('layouts.admin')

@section('title', 'Admin Dashboard - LMS')

@section('content')
    <h3 class="mb-4" style="color: #2f1ba1; font-weight: 600;">Welcome Admin</h3>

    <div class="row g-4">
        <!-- Date Time Box -->
        <div class="ms-auto d-flex align-items-center justify-content-end mb-3 datetime-box">
            <i class="fa fa-calendar me-2 text-primary"></i>
            <span id="date"></span>
            <span class="mx-2">|</span>
            <i class="fa fa-clock-o me-2 text-primary"></i>
            <span id="time"></span>
        </div>

        <!-- Total Books -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.books.index') }}" class="text-decoration-none">
                <div class="card text-bg-primary shadow border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 small">Total Books</h6>
                            <h3 class="fw-bold">{{ $stats['total_books'] }}</h3>
                        </div>
                        <i class="bi bi-book fa-3x opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Members -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card text-bg-success shadow border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 small">Total Members</h6>
                            <h3 class="fw-bold">{{ $stats['total_members'] }}</h3>
                        </div>
                        <i class="bi bi-people fa-3x opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Issued Books -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.transactions.issued') }}" class="text-decoration-none">
                <div class="card text-bg-warning shadow border-0 text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 small">Issued Books</h6>
                            <h3 class="fw-bold">{{ $stats['issued_books'] }}</h3>
                        </div>
                        <i class="bi bi-journal-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Returned Books -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.transactions.returned') }}" class="text-decoration-none">
                <div class="card text-bg-secondary shadow border-0 text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 small">Returned Books</h6>
                            <h3 class="fw-bold">{{ $stats['returned_books'] }}</h3>
                        </div>
                        <i class="bi bi-arrow-return-left fa-3x opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Reserved Books -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('admin.reservations.index') }}" class="text-decoration-none">
                <div class="card text-bg-info shadow border-0 text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 small">Reserved Books</h6>
                            <h3 class="fw-bold">{{ $stats['reserved_books'] }}</h3>
                        </div>
                        <i class="bi bi-journal-bookmark fa-3x opacity-50"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Fine Collected -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-bg-danger shadow border-0 text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2 small">Fine Collected</h6>
                        <h3 class="fw-bold">₹: {{ number_format($stats['total_fine'], 2) }}</h3>
                    </div>
                    <i class="bi bi-currency-rupee fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateDateTime() {
            const now = new Date();

            document.getElementById("date").innerHTML =
                now.toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });

            document.getElementById("time").innerHTML =
                now.toLocaleTimeString('en-IN', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
@endsection

@section('styles')
    <style>
        .datetime-box {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .card i {
            font-size: 2.5rem;
        }
    </style>
@endsection