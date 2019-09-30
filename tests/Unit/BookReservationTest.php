<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Book;
use App\User;
use App\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{

    use  RefreshDatabase;

    /** @test */
    public function a_book_can_be_checked_out()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $this->assertCount(0,Reservation::all());
        $book->checkout($user);
        $this->assertCount(1,Reservation::all());
        $this->assertEquals($user->id,Reservation::first()->user_id);
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals(now(),Reservation::first()->checked_out_at);
        
    }

    /** @test */
    public function a_book_can_be_returned()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $this->assertCount(0,Reservation::all());
        $book->checkout($user);
        $book->checkin($user);
        $this->assertCount(1,Reservation::all());
        $this->assertEquals($user->id,Reservation::first()->user_id);
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertNotNull(Reservation::first()->checked_in_at);
        $this->assertEquals(now(),Reservation::first()->checked_in_at);
        
    }

    /** @test */
    public function if_not_checked_out_exception_is_thrown()
    {
        
        $this->expectException(\Exception::class);
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $book->checkin($user);
        
    }


    
}
