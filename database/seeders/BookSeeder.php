<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run()
    {
        $orwell = Author::where('name', 'George Orwell')->first();
        $rowling = Author::where('name', 'J.K. Rowling')->first();
        $twain = Author::where('name', 'Mark Twain')->first();

        Book::create([
            'title' => '1984',
            'description' => 'A dystopian social science fiction novel and cautionary tale.',
            'publish_date' => Carbon::parse('1949-06-08'),
            'author_id' => $orwell->id,
        ]);

        Book::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'description' => 'The first novel in the Harry Potter series.',
            'publish_date' => Carbon::parse('1997-06-26'),
            'author_id' => $rowling->id,
        ]);

        Book::create([
            'title' => 'Adventures of Huckleberry Finn',
            'description' => 'A novel by Mark Twain, first published in 1884.',
            'publish_date' => Carbon::parse('1884-12-10'),
            'author_id' => $twain->id,
        ]);
    }
}

