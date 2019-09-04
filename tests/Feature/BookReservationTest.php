<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        

        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'Jhonatan',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Jhonatan',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

        /** @test */
        public function a_book_can_be_updated()
        {
            $this->withoutExceptionHandling();
            $this->post('/books', [
                'title' => 'Cool title',
                'author' => 'Jhonatan',
            ]);


            $book = Book::first();

            $response = $this->patch('/books/' . $book->id ,[
                'title' => 'new title',
                'author' => 'new author',
            ]);
    
            $this->assertEquals('new title',Book::first()->title);
            $this->assertEquals('new author',Book::first()->author);
        }
    
}
