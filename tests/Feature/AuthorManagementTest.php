<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        //$this->withoutExceptionHandling();
        $this->post('/authors', $this->data());

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function a_name_is_requeired()
    {

        $reponse = $this->post('/authors', array_merge($this->data(), array('name' => '')));
        $reponse->assertSessionHasErrors('name');
    }

     /** @test */
     public function a_dob_is_requeired()
     {
 
         $reponse = $this->post('/authors', array_merge($this->data(), array('dob' => '')));
         $reponse->assertSessionHasErrors('dob');
     }

    private function data()
    {
        return [
            'name' => 'Paulo Coelho',
            'dob' => '05/14/1988'
        ];
    }
}
