<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\TransactionController as AdminTransaction;
use App\Http\Controllers\Admin\ReservationController as AdminReservation;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\BookController as AdminBook;
use App\Http\Controllers\User\ReservationController as UserReservation;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');

        // User Reservation routes
        Route::get('user/reservations', [UserReservation::class, 'index'])->name('user.reservations.index');
        Route::get('user/reservations/create', [UserReservation::class, 'create'])->name('user.reservations.create');
        Route::post('user/reservations', [UserReservation::class, 'store'])->name('user.reservations.store');
    });








    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

        Route::resource('admin/books', AdminBook::class)->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);

        Route::resource('admin/users', AdminUser::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        // Transaction routes
        Route::get('admin/transactions/issue', [AdminTransaction::class, 'showIssueForm'])->name('admin.transactions.issue');
        Route::post('admin/transactions/issue', [AdminTransaction::class, 'issueBook']);
        Route::get('admin/transactions/issued', [AdminTransaction::class, 'issued'])->name('admin.transactions.issued');
        Route::get('admin/transactions/return', [AdminTransaction::class, 'showReturnForm'])->name('admin.transactions.return');
        Route::post('admin/transactions/return', [AdminTransaction::class, 'returnBook']);
        Route::get('admin/transactions/returned', [AdminTransaction::class, 'returned'])->name('admin.transactions.returned');

        // Reservation routes
        Route::get('admin/reservations', [AdminReservation::class, 'index'])->name('admin.reservations.index');
        Route::post('admin/reservations/{reservation}/approve', [AdminReservation::class, 'approve'])->name('admin.reservations.approve');
        Route::post('admin/reservations/{reservation}/reject', [AdminReservation::class, 'reject'])->name('admin.reservations.reject');
    });
});
