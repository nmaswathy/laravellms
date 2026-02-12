@extends('layouts.admin')

@section('title', 'Return Book - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">Return a Book</h3>

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
                        <th>Book Title</th>
                        <th>User</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Fine (Est.)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->book->title }}</td>
                            <td>{{ $transaction->user->name }} ({{ $transaction->user->email }})</td>
                            <td>{{ $transaction->issue_date }}</td>
                            <td>{{ $transaction->due_date }}</td>
                            <td>
                                @php
                                    $dueDate = \Illuminate\Support\Carbon::parse($transaction->due_date);
                                    $fine = 0;
                                    if (now()->gt($dueDate)) {
                                        $fine = now()->diffInDays($dueDate) * 10;
                                    }
                                @endphp
                                <span class="{{ $fine > 0 ? 'text-danger fw-bold' : '' }}">
                                    ₹{{ $fine }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.transactions.return') }}" method="POST"
                                    onsubmit="return confirm('Confirm return for {{ $transaction->book->title }}?')">
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                    <button type="submit" class="btn btn-sm btn-success fw-bold">
                                        Return Book
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No books currently issued.</td>
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