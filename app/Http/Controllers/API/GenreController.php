<?php

namespace App\Http\Controllers\API;

use App\Genre;
use App\Http\Controllers\Controller;
use App\Http\Resources\Genre as GenreResource;
use Illuminate\Http\Request;
use \App\Http\Requests\Genre\StoreGenre;
use \App\Http\Requests\Genre\UpdateGenre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : Genre::count();
        $genres = Genre::orderBy('id')
            ->offset($offset)
            ->limit($limit)
            ->get();
        $dataForResponse = GenreResource::collection($genres);

        return response()->json($dataForResponse, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Genre\StoreGenre  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenre $request)
    {
        $validatedData = $request->validated();

        $genre = new Genre();
        $genre->fill($validatedData);
        $genre->save();

        $dataForResponse = new GenreResource($genre);

        return response()->json($dataForResponse, 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Genre\UpdateGenre  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenre $request, Genre $genre)
    {
        $validatedData = $request->validated();

        $genre->fill($validatedData);
        $genre->save();

        $dateForResponse = new GenreResource($genre);

        return response()->json($dateForResponse, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response(null, 204);
    }
}
