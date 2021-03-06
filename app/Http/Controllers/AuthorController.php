<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
public function create(){
    return view('authors.create');
}

    public function store(Request $request)
    {

        Author::create($this->validateRequest());
    }

    protected function validateRequest(){
        return request()->validate([
            'name' => 'required',
            'dob'  => 'required'
        ]);
    }


}
