<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $fillable =['title','author'];

    public function path(){
        return '/books/' . $this->id . '-' . \Str::slug($this->title); 
    }
}
