@extends('layouts.admin')

@section('title', 'Book Reservations - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">Book Reservations</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Reserved Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $index => $reservation)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                                $reservation->status == 'approved' ? 'success' :
                        ($reservation->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $reservation->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if ($reservation->status == 'pending')
                                            <div class="btn-group">
                                                <form action="{{ route('admin.reservations.approve', $reservation->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.reservations.reject', $reservation->id) }}" method="POST"
                                                    style="display:inline;" class="ms-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted small">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-danger">No Reservations Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
@endsection