<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'user']);
    }

    public function test_user_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->user)->get(route('user.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('transactions');
        $response->assertViewHas('reservations');
    }

    public function test_user_can_see_reservation_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('user.reservations.create'));

        $response->assertStatus(200);
        $response->assertViewHas('books');
    }

    public function test_user_can_reserve_a_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->post(route('user.reservations.store'), [
            'book_id' => $book->id,
        ]);

        $response->assertRedirect(route('user.reservations.index'));
        $this->assertDatabaseHas('reservations', [
            'user_id' => $this->user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_cannot_reserve_same_book_twice(): void
    {
        $book = Book::factory()->create();
        Reservation::create([
            'user_id' => $this->user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user)->post(route('user.reservations.store'), [
            'book_id' => $book->id,
        ]);

        $response->assertSessionHas('error', 'You already have a pending reservation for this book.');
    }

    public function test_user_cannot_exceed_reservation_limit(): void
    {
        $books = Book::factory()->count(3)->create();
        foreach ($books as $book) {
            Reservation::create([
                'user_id' => $this->user->id,
                'book_id' => $book->id,
                'status' => 'pending',
            ]);
        }

        $anotherBook = Book::factory()->create();
        $response = $this->actingAs($this->user)->post(route('user.reservations.store'), [
            'book_id' => $anotherBook->id,
        ]);

        $response->assertSessionHas('error', 'You can only have a maximum of 3 active reservations at a time.');
    }
}
