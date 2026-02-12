@extends('layouts.admin')

@section('title', 'Add New Book - LMS')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold" style="color: #2f1ba1;">Add New Book</h3>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Author</label>
                            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                                value="{{ old('author') }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                                value="{{ old('category') }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">ISBN</label>
                            <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                value="{{ old('isbn') }}">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Language</label>
                            <input type="text" name="language" class="form-control @error('language') is-invalid @enderror"
                                value="{{ old('language') }}">
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', 0) }}" required min="0">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Book Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Save Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection