<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function showIssueForm()
    {
        $books = Book::where('available_qty', '>', 0)->get();
        $users = User::where('role', 'user')->get();
        return view('admin.transactions.issue', compact('books', 'users'));
    }

    public function issueBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->available_qty <= 0) {
            return back()->with('error', 'Book is not available for issue.');
        }

        Transaction::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'issue_date' => Carbon::today(),
            'due_date' => Carbon::today()->addDays(7),
            'status' => 'issued',
        ]);

        $book->decrement('available_qty');

        return redirect()->route('admin.dashboard')->with('success', 'Book issued successfully.');
    }

    public function showReturnForm()
    {
        $transactions = Transaction::where('status', 'issued')->with(['book', 'user'])->get();
        return view('admin.transactions.return', compact('transactions'));
    }

    public function returnBook(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        if ($transaction->status !== 'issued') {
            return back()->with('error', 'This book has already been returned.');
        }

        $dueDate = Carbon::parse($transaction->due_date);
        $returnDate = Carbon::today();
        $fine = 0;

        if ($returnDate->gt($dueDate)) {
            $daysOverdue = $returnDate->diffInDays($dueDate);
            $fine = $daysOverdue * 10; // 10 units per day fine
        }

        $transaction->update([
            'return_date' => $returnDate,
            'fine' => $fine,
            'status' => 'returned',
        ]);

        $transaction->book->increment('available_qty');

        return redirect()->route('admin.dashboard')->with('success', 'Book returned successfully. Fine: ₹' . $fine);
    }

    public function issued()
    {
        $transactions = Transaction::where('status', 'issued')->with(['book', 'user'])->orderBy('id', 'DESC')->get();
        return view('admin.transactions.issued', compact('transactions'));
    }

    public function returned()
    {
        $transactions = Transaction::where('status', 'returned')->with(['book', 'user'])->orderBy('id', 'DESC')->get();
        return view('admin.transactions.returned', compact('transactions'));
    }
}
