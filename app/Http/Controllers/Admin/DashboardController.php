<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_members' => User::where('role', 'user')->count(),
            'issued_books' => Transaction::where('status', 'issued')->count(),
            'returned_books' => Transaction::where('status', 'returned')->count(),
            'reserved_books' => Reservation::where('status', 'pending')->count(),
            'total_fine' => Transaction::sum('fine'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
