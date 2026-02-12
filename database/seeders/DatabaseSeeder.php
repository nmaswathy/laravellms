<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('123'), // Or use Hash::make('password')
                'role' => 'admin',
                'phone' => '789456',
                'image' => 'default.png',
            ]
        );
        // user 
        User::updateOrCreate(
            ['email' => 'aswathy@gmail.com'],
            [
                'name' => 'aswathy',
                'password' => bcrypt('123'), // Or use Hash::make('password')
                'role' => 'user',
                'phone' => '7034607883',
                'image' => 'default.png',
            ]
        );

        // Sample Books
        \App\Models\Book::create([
            'title' => 'orikkal',
            'author' => 'mohan',
            'category' => 'noval',
            'isbn' => '126',
            'language' => 'malayalam',
            'quantity' => 15,
            'available_qty' => 11,
        ]);

        \App\Models\Book::create([
            'title' => 'Randamuzham',
            'author' => 'M.T Vasudevan',
            'category' => 'Noval',
            'isbn' => '1005',
            'language' => 'malayalam',
            'quantity' => 4,
            'available_qty' => 4,
        ]);

        // Generate 100 books
        \App\Models\Book::factory(100)->create();

        // Generate 50 users
        \App\Models\User::factory(50)->create();
    }
}
