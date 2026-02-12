<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');

        // User Reservation routes
        Route::get('user/reservations', [\App\Http\Controllers\User\ReservationController::class, 'index'])->name('user.reservations.index');
        Route::get('user/reservations/create', [\App\Http\Controllers\User\ReservationController::class, 'create'])->name('user.reservations.create');
        Route::post('user/reservations', [\App\Http\Controllers\User\ReservationController::class, 'store'])->name('user.reservations.store');
    });

    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

        Route::resource('admin/books', \App\Http\Controllers\Admin\BookController::class)->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);

        Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        // Transaction routes
        Route::get('admin/transactions/issue', [\App\Http\Controllers\Admin\TransactionController::class, 'showIssueForm'])->name('admin.transactions.issue');
        Route::post('admin/transactions/issue', [\App\Http\Controllers\Admin\TransactionController::class, 'issueBook']);
        Route::get('admin/transactions/issued', [\App\Http\Controllers\Admin\TransactionController::class, 'issued'])->name('admin.transactions.issued');
        Route::get('admin/transactions/return', [\App\Http\Controllers\Admin\TransactionController::class, 'showReturnForm'])->name('admin.transactions.return');
        Route::post('admin/transactions/return', [\App\Http\Controllers\Admin\TransactionController::class, 'returnBook']);
        Route::get('admin/transactions/returned', [\App\Http\Controllers\Admin\TransactionController::class, 'returned'])->name('admin.transactions.returned');

        // Reservation routes
        Route::get('admin/reservations', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('admin.reservations.index');
        Route::post('admin/reservations/{reservation}/approve', [\App\Http\Controllers\Admin\ReservationController::class, 'approve'])->name('admin.reservations.approve');
        Route::post('admin/reservations/{reservation}/reject', [\App\Http\Controllers\Admin\ReservationController::class, 'reject'])->name('admin.reservations.reject');
    });
});
