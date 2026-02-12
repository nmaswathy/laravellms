@extends('layouts.admin')

@section('title', 'Edit User - LMS')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold" style="color: #2f1ba1;">Edit User</h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            <p class="small text-muted mt-1">Leave blank to keep current password</p>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-center">
                            <label class="form-label fw-semibold d-block text-start">Profile Image</label>
                            @if ($user->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Current Image"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                    <p class="small text-muted">Current Profile Image</p>
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection