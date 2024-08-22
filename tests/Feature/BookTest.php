<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        // Ensure that the author exists in the database
        $author = \App\Models\Author::factory()->create();

        // Prepare data for the new book
        $data = [
            'title' => 'The Great Gatsby',
            'description' => 'A novel written by American author F. Scott Fitzgerald.',
            'publish_date' => '1925-04-10',
            'author_id' => $author->id, // Use an existing author ID
        ];

        // Send a POST request to create a new book
        $response = $this->postJson('/api/books', $data);

        // Assert the response status is 201 (Created) and includes the 'author_id' key
        $response->assertStatus(201)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'title',
                        'description',
                        'publish_date',
                        'author_id', 
                        'author' => [ 
                            'id',
                            'name',
                            'bio',
                            'birth_date',
                        ]
                    ]
                ]);
    }


    /** @test */
    public function it_can_retrieve_a_book()
    {
        // Ensure that an author exists in the database
        $author = \App\Models\Author::factory()->create();

        // Create a book using the factory
        $book = \App\Models\Book::factory()->create([
            'author_id' => $author->id, // Associate the book with the existing author
        ]);

        // Send a GET request to retrieve the book
        $response = $this->getJson('/api/books/' . $book->id);

        // Assert the response status is 200 (OK) and includes the book details
        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $book->id,
                        'title' => $book->title,
                        'description' => $book->description,
                        'publish_date' => $book->publish_date,
                        'author_id' => $book->author_id,
                        'author' => [
                            'id' => $book->author->id,
                            'name' => $book->author->name,
                            'bio' => $book->author->bio,
                            'birth_date' => $book->author->birth_date,
                        ],
                    ]
                ]);
    }

    public function it_can_update_a_book()
    {
        $book = Book::factory()->create();

        $data = [
            'title' => '1984 Updated',
            'description' => 'Updated description',
            'publish_date' => '1949-06-08',
            'author_id' => $book->author_id,
        ];

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['title' => '1984 Updated']);
    }

    /** @test */
    public function it_can_delete_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /** @test */
    public function it_returns_404_when_book_not_found()
    {
        $response = $this->getJson('/api/books/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_a_book()
    {
        $response = $this->postJson('/api/books', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'publish_date', 'author_id']);
    }
}
