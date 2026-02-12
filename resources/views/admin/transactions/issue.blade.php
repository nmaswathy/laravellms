@extends('layouts.admin')

@section('title', 'Issue Book - LMS')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 p-4">
                <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">Issue a Book</h3>

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

                <form action="{{ route('admin.transactions.issue') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select User</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Book</label>
                        <select name="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                            <option value="">-- Select Book --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} (Available: {{ $book->available_qty }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">Issue Book</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection