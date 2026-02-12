@extends('layouts.admin')

@section('title', 'Manage Books - LMS')

@section('content')
    <div class="card shadow border-0 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold" style="color: #2f1ba1;">Manage Books</h3>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.books.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search books..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Book
                </a>
            </div>
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
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Qty</th>
                        <th>Avail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book"
                                        style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 70px; border-radius: 4px;">
                                        <i class="bi bi-book text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <span class="badge {{ $book->available_qty > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $book->available_qty }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')">
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
                            <td colspan="9" class="text-center py-4">No books found in the library.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection