<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::orderBy('id', 'DESC');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('isbn', 'like', "%{$search}%");
        }

        $books = $query->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:20|unique:books,isbn',
            'language' => 'nullable|string|max:50',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/images', 'public');
            $data['image'] = $imagePath;
        }

        $data['available_qty'] = $data['quantity'];
        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'language' => 'nullable|string|max:50',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $imagePath = $request->file('image')->store('assets/images', 'public');
            $data['image'] = $imagePath;
        }

        // Adjust available_qty
        $qtyDiff = $data['quantity'] - $book->quantity;
        $data['available_qty'] = $book->available_qty + $qtyDiff;

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
