<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_can_be_created(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $transaction = Transaction::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'issue_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'issued',
        ]);

        $this->assertDatabaseHas('transactions', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 'issued',
        ]);

        $this->assertInstanceOf(Book::class, $transaction->book);
        $this->assertInstanceOf(User::class, $transaction->user);
    }
}
