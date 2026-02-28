<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_page_notcontains_books_table()
    {
        $response =$this->get('/views/books');
        $response->assertStatus(404);
        $response->assertDontSee('Books Table');
    }
   
    }


