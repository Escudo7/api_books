<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Book;
use \App\Author;
use \App\Genre;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->filteredKeys = ['updated_at', 'created_at', 'deleted_at', 'pivot'];
    }

    public function testIndex()
    {
        $books = factory(Book::class, 2)
            ->create()
            ->each(function ($book) {
                $book->authors()->save(factory(Author::class)->make());
                $book->genres()->save(factory(Genre::class)->make());
            });


        $response = $this->getJson(route('books.index'));

        $expectedJson = $books->map(function ($book) {
            $bookFiltered = collect($book->toArray())->except($this->filteredKeys);

            $authorsFiltered = $book->authors->map(function ($author) {
                return collect($author->toArray())->except($this->filteredKeys);
            })->toArray();

            $genresFiltred = $book->genres->map(function ($genre) {
                return collect($genre->toArray())->except($this->filteredKeys);
            })->toArray();

            $bookFiltered['authors'] = $authorsFiltered;
            $bookFiltered['genres'] = $genresFiltred;

            return $bookFiltered;
        })->toArray();

        $response
            ->assertStatus(200)
            ->assertExactJson($expectedJson);
    }

    public function testStore()
    {
        $author = factory(Author::class)->create();
        $genre = factory(Genre::class)->create();
        $modelBook = factory(Book::class)->make();

        $data = array_merge(
            $modelBook->toArray(),
            ['authors' => [$author->id]],
            ['genres' => [$genre->id]]
        );
        $response = $this->postJson(route('books.store'), $data);

        $authorCollect = collect($author->toArray());
        $genreCollect = collect($genre->toArray());
        $expectedJson = array_merge(
            $modelBook->toArray(),
            ['authors' => [$authorCollect->except($this->filteredKeys)->toArray()]],
            ['genres' => [$genreCollect->except($this->filteredKeys)->toArray()]],
            ['id' => 1]
        );

        $response
            ->assertStatus(201)
            ->assertExactJson($expectedJson);
        $this->assertEquals(1, Book::where('name', $modelBook->name)->count());
    }

    public function testUpdate()
    {
        $book = factory(Book::class)
            ->create()
            ->each(function ($book) {
                $book->authors()->save(factory(Author::class)->make());
                $book->genres()->save(factory(Genre::class)->make());
            });


        $dataForUpdate = factory(Book::class)->make()->toArray();
        $response = $this->patchJson(route('books.update', $book), $dataForUpdate);

        $expectedJson = array_merge($dataForUpdate, ['id' => 1]);
        $response
            ->assertStatus(200)
            ->assertJson($expectedJson);
        $this->assertEquals(1, Book::where('name', $dataForUpdate['name'])->count());
    }

    public function testDelete()
    {
        $book = factory(Book::class)
            ->create()
            ->each(function ($book) {
                $book->authors()->save(factory(Author::class)->make());
                $book->genres()->save(factory(Genre::class)->make());
            });

        $response = $this->deleteJson(route('books.destroy', $book));

        $response
            ->assertStatus(204);
    }
}
