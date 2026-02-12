@extends('layouts.user')

@section('title', 'Reserve Book - LMS')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4">
                <h3 class="mb-4 text-center fw-bold" style="color: #4a5568;">Reserve a Book</h3>

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

                <form action="{{ route('user.reservations.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Book Name</label>
                        <select name="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                            <option value="">-- Choose Book --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">Submit Request</button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection