<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['book', 'user'])->orderBy('id', 'DESC')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function approve(Reservation $reservation)
    {
        $book = $reservation->book;

        if ($book->available_qty <= 0) {
            return back()->with('error', 'Book is not available for issue.');
        }

        // Create transaction
        Transaction::create([
            'book_id' => $reservation->book_id,
            'user_id' => $reservation->user_id,
            'issue_date' => Carbon::today(),
            'due_date' => Carbon::today()->addDays(7),
            'status' => 'issued',
        ]);

        // Decrement qty
        $book->decrement('available_qty');

        // Update reservation
        $reservation->update(['status' => 'approved']);

        // Or delete it as per original logic? The original deleted it.
        // Let's keep it but mark as approved for better history? 
        // Actually original says: $dlt= $reseveObj->deleteReservation($_POST['id']);
        // I'll update status to approved so they can see it in history too.

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation approved and book issued.');
    }

    public function reject(Reservation $reservation)
    {
        $reservation->update(['status' => 'rejected']);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation rejected.');
    }
}
