<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_can_be_created(): void
    {
        $book = Book::factory()->create([
            'title' => 'Test Book',
            'author' => 'Test Author',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'author' => 'Test Author',
        ]);

        $this->assertEquals('Test Book', $book->title);
    }

    public function test_book_has_available_quantity(): void
    {
        $book = Book::factory()->create([
            'quantity' => 10,
            'available_qty' => 10,
        ]);

        $this->assertEquals(10, $book->available_qty);
    }
    
}