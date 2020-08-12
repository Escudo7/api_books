<?php

namespace App\Http\Controllers\API;

use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Requests\Author\StoreAuthor;
use \App\Http\Requests\Author\UpdateAuthor;
use \App\Http\Resources\Author as AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : Author::count();
        $authors = Author::orderBy('id')
            ->offset($offset)
            ->limit($limit)
            ->get();
        $dataForResponse = AuthorResource::collection($authors);

        return response()->json($dataForResponse, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Author\StoreAuthor $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthor $request)
    {
        $validatedData = $request->validated();

        $author = new Author();
        $author->fill($validatedData);
        $author->save();

        $dataForResponse = new AuthorResource($author);
        return response()->json($dataForResponse, 201, [], JSON_UNESCAPED_UNICODE);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Author\UpdateAuthor  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthor $request, Author $author)
    {
        $validatedData = $request->validated();

        $author->fill($validatedData);
        $author->save();

        $dataForResponse = new AuthorResource($author);
        return response()->json($dataForResponse, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, 204);
    }
}
