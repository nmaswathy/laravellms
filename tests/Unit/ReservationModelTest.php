<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_reservation_can_be_created(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $reservation = Reservation::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'reservation_date' => now(),
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('reservations', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $this->assertInstanceOf(Book::class, $reservation->book);
        $this->assertInstanceOf(User::class, $reservation->user);
    }
}
