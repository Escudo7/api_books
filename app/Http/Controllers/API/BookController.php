<?php

namespace App\Http\Controllers\API;

use App\Author;
use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book as BookResource;
use Illuminate\Http\Request;
use \App\Http\Requests\Book\StoreBook;
use \App\Http\Requests\Book\UpdateBook;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : Book::count();
        $authors = Book::orderBy('id')
            ->offset($offset)
            ->limit($limit)
            ->get();
        $dataForResponse = BookResource::collection($authors);

        return response()->json($dataForResponse, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Book\StoreBook  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBook $request)
    {
        $validatedData = $request->validated();

        $book = new Book();
        $book->fill($validatedData);
        $book->save();

        $book->authors()->attach($request->input('authors'));
        $book->genres()->attach($request->input('genres'));

        $dataForResponse = new BookResource($book);

        return response()->json($dataForResponse, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Book\UpdateBook  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBook $request, Book $book)
    {
        $validatedData = $request->validated();

        $book->fill($validatedData);
        $book->save();

        if ($request->input('authors')) {
            $book->authors()->detach();
            $book->authors()->attach($request->input('authors'));
        }

        if ($request->input('genres')) {
            $book->genres()->detach();
            $book->genres()->attach($request->input('genres'));
        }

        $dataForRequest = new BookResource($book);
        return response()->json($dataForRequest, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, 204);
    }
}
