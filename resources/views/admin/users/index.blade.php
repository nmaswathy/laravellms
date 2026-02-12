@extends('layouts.admin')

@section('title', 'Manage Users - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #2f1ba1;">Manage Users</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i>Add New User
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="User"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; border-radius: 50%;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection