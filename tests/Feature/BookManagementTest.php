<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {

        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'Jhonatan',
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
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
            //$this->withoutExceptionHandling();
            $this->post('/books', [
                'title' => 'Cool title',
                'author' => 'Jhonatan',
            ]);


            $book = Book::first();

            $response = $this->patch($book->path() ,[
                'title' => 'new title',
                'author' => 'new author',
            ]);
    
            $this->assertEquals('new title',Book::first()->title);
            $this->assertEquals('new author',Book::first()->author);

            $response->assertRedirect($book->fresh()->path() );
        }



        /** @test */
        public function a_book_can_be_deleted()
        {
            //$this->withoutExceptionHandling();
            
            $this->post('/books', [
                'title' => 'Cool title',
                'author' => 'Jhonatan',
            ]);
            $this->assertCount(1, Book::all());

            $book = Book::first();

            $response = $this->delete($book->path() );

            $this->assertCount(0, Book::all());

            $response->assertRedirect('/books');

        }
    
}