<?php

namespace App;
use App\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded =[];

    public function path(){
        return '/books/' . $this->id . '-' . \Str::slug($this->title); 
    }


    public function setAuthorIdAttribute($author){
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,
        ]))->id;
    }
}
