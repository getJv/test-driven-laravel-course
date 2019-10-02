@extends('layouts.app')
@section('content')
    <div class="w-2/3 bg-gray-300 mx-auto p-6">
        <h1> Page Author</h1>
    <form action="/authors" method="post">
        @csrf


        <div class="pt-4">
            <input class="rounded py-2 px-4" type="text" name="name" placeholder="Full Name">

            @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="pt-4">
            <input class="rounded py-2 px-4" type="text" name="dob" placeholder="Date of Birth">
            @error('dob') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="pt-4" >
            <button class="mt-4 bg-blue-400 text-white rounded py-2 px-4" type="submit">Add Author</button>
        </div>
    </form>


    </div>
@endsection
