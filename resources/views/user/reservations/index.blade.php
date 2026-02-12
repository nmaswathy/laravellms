@extends('layouts.user')

@section('title', 'My Reservations - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">My Book Reservations</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <th>Status</th>
                        <th>Reserved Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $index => $reservation)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                                $reservation->status == 'approved' ? 'success' :
                        ($reservation->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $reservation->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-danger">You have no reservations.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
@endsection