<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_author()
    {
        $data = [
            'name' => 'George Orwell',
            'bio' => 'English novelist and essayist',
            'birth_date' => '1903-06-25',
        ];

        $response = $this->postJson('/api/authors', $data);

        $response->assertStatus(201) 
        ->assertJson([
            'data' => [
                'name' => 'George Orwell',
                'bio' => 'English novelist and essayist',
                'birth_date' => '1903-06-25',
            ],
        ]); 
    }

  /** @test */
    public function it_can_retrieve_an_author()
    {
        $author = \App\Models\Author::factory()->create();

        $response = $this->getJson("/api/authors/{$author->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $author->id,
                        'name' => $author->name,
                        'bio' => $author->bio,
                        'birth_date' => $author->birth_date,
                    ]
                ]);
    }

   /** @test */
    public function it_can_update_an_author()
    {
        $author = \App\Models\Author::factory()->create(); // Create an author

        $updatedData = [
            'name' => 'Updated Name',
            'bio' => 'Updated bio',
            'birth_date' => '1900-01-01',
        ];

        $response = $this->putJson("/api/authors/{$author->id}", $updatedData);

        $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'id' => $author->id,
                        'name' => 'Updated Name',
                        'bio' => 'Updated bio',
                        'birth_date' => '1900-01-01',
                    ]
                ]);
    }

    /** @test */
    public function it_can_delete_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    /** @test */
    public function it_returns_404_when_author_not_found()
    {
        $response = $this->getJson('/api/authors/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_an_author()
    {
        $response = $this->postJson('/api/authors', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'birth_date']);
    }
}
