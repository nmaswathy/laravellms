<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)
            ->with('book')
            ->orderBy('id', 'DESC')
            ->get();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('book')
            ->orderBy('id', 'DESC')
            ->get();

        return view('user.dashboard', compact('user', 'transactions', 'reservations'));
    }
}
