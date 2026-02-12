@extends('layouts.admin')

@section('title', 'Issued Books - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">Issued Books</h3>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th>User</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $index => $transaction)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaction->book->title }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->issue_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->due_date)->format('d M Y') }}</td>
                            <td>₹{{ number_format($transaction->fine, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-danger">No Issued Books Found</td>
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