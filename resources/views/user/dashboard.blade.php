@extends('layouts.user')

@section('title', 'User Dashboard - LMS')

@section('content')
    <div class="row">
        <!-- Profile Section -->
        <div class="col-md-4">
            <div class="profile-card bg-white p-4 rounded shadow-sm text-center">
                @if ($user->image)
                    <img src="{{ asset($user->image) }}" alt="Profile" class="profile-img mb-3">
                @else
                    <div
                        class="profile-img bg-secondary d-flex align-items-center justify-content-center mx-auto text-white mb-3">
                        <i class="fa fa-user fa-4x"></i>
                    </div>
                @endif

                <h3 class="fw-bold">{{ $user->name }}</h3>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge bg-success">Active User</span>
            </div>
        </div>

        <!-- Borrowed Books Section -->
        <div class="col-md-8">
            <h4 class="mb-4 text-secondary">My Borrowed Books</h4>

            <div class="row">
                @forelse ($transactions as $transaction)
                    <div class="col-md-6 mb-3">
                        <div class="book-card bg-white p-3 d-flex align-items-center rounded shadow-sm">
                            @if ($transaction->book->image)
                                <img src="{{ asset($transaction->book->image) }}" alt="Book"
                                    style="width: 60px; height: 80px; object-fit: cover; border-radius: 5px;" class="me-3">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center me-3"
                                    style="width: 60px; height: 80px; border-radius: 5px;">
                                    <i class="fa fa-book text-muted"></i>
                                </div>
                            @endif

                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $transaction->book->title }}</h6>
                                <p class="mb-1 small text-muted">Issued: {{ $transaction->issue_date }}</p>
                                <p class="mb-1 small text-muted">Due: {{ $transaction->due_date }}</p>

                                @if ($transaction->status == 'issued')
                                    <span class="badge bg-warning text-dark">Borrowed</span>
                                @else
                                    <span class="badge bg-success">Returned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-light">
                            No borrowing history found.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .profile-card {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f0f2f5;
        }

        .book-card {
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection