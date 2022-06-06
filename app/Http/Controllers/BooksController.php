<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorsResource;
use App\Http\Resources\BooksResource;
use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BooksResource::collection(Book::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return BooksResource
     */
    public function store(StoreBookRequest $request)
    {
        $faker = \Faker\Factory::create(1);
        $book = Book::create([
            'name' => $faker->name,
            'description' => $faker->sentence,
            'publication_year' => (string)$faker->year,
        ]);
        return new BooksResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return BooksResource
     */
    public function show(Book $book)
    {
        return new BooksResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return BooksResource
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update([
            'name' => Request::input('name'),
            'description' => Request::input('description'),
            'publication_year' => Request::input('publication_year')
        ]);

        return new BooksResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response(null,204);
    }
}
