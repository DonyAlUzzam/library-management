<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Carbon\Carbon;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::create([
            'name' => 'George Orwell',
            'bio' => 'George Orwell was an English novelist and essayist.',
            'birth_date' => Carbon::parse('1903-06-25'),
        ]);

        Author::create([
            'name' => 'J.K. Rowling',
            'bio' => 'J.K. Rowling is a British author, best known for the Harry Potter series.',
            'birth_date' => Carbon::parse('1965-07-31'),
        ]);

        Author::create([
            'name' => 'Mark Twain',
            'bio' => 'Mark Twain was an American writer, humorist, and lecturer.',
            'birth_date' => Carbon::parse('1835-11-30'),
        ]);
    }
}
