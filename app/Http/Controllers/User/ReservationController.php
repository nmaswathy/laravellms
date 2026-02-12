<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create()
    {
        $books = Book::all();
        return view('user.reservations.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = Auth::user();

        // Check if user already has a pending reservation for this book
        $exists = Reservation::where('user_id', $user->id)
            ->where('book_id', $request->book_id)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending reservation for this book.');
        }

        // Limit to 3 active reservations (pending or approved)
        $activeReservationsCount = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($activeReservationsCount >= 3) {
            return back()->with('error', 'You can only have a maximum of 3 active reservations at a time.');
        }

        Reservation::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
            'status' => 'pending',
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Book reservation request submitted.');
    }

    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
            ->with('book')
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }
}
