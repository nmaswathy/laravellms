<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_see_book_list(): void
    {
        Book::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get(route('admin.books.index'));

        $response->assertStatus(200);
        $response->assertViewHas('books');
    }

    public function test_admin_can_add_book(): void
    {
        $bookData = [
            'title' => 'New Awesome Book',
            'author' => 'Great Author',
            'category' => 'Technology',
            'isbn' => '1234567890123',
            'quantity' => 5,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.books.store'), $bookData);

        $response->assertRedirect(route('admin.books.index'));
        $this->assertDatabaseHas('books', ['title' => 'New Awesome Book']);
    }

    public function test_admin_can_update_book(): void
    {
        $book = Book::factory()->create(['title' => 'Old Title']);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.books.update', $book), [
                'title' => 'Updated Title',
                'author' => $book->author,
                'quantity' => $book->quantity,
            ]);

        $response->assertRedirect(route('admin.books.index'));
        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Updated Title']);
    }

    public function test_admin_can_delete_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.books.destroy', $book));

        $response->assertRedirect(route('admin.books.index'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
