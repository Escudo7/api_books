<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $authors = factory(Author::class, 2)->create();
        $response = $this->getJson(route('authors.index'));

        $expectedJson = array_map(function ($author) {
            return array_filter($author, function ($key) {
                return $key !== 'updated_at' && $key !== 'created_at';
            }, ARRAY_FILTER_USE_KEY);
        }, $authors->toArray());

        $response
            ->assertStatus(200)
            ->assertExactJson($expectedJson);

    }

    public function testStore()
    {
        $modelAuthor = factory(Author::class)->make();
        $response = $this->postJson(route('authors.store'), $modelAuthor->toArray());

        $expectedJson = array_merge($modelAuthor->toArray(), ['id' => 1]);
        $response
            ->assertStatus(201)
            ->assertExactJson($expectedJson);
        $this->assertEquals(1, Author::where('name', $modelAuthor->first_name)->count());
    }

    public function testUpdate()
    {
        $modelAuthor = factory(Author::class)->create();
        $dataForUpdate = factory(Author::class)->make()->toArray();
        $response = $this->patchJson(route('authors.update', $modelAuthor->id), $dataForUpdate);

        $expectedJson = array_merge($dataForUpdate, ['id' => $modelAuthor->id]);
        $response
            ->assertStatus(201)
            ->assertExactJson($expectedJson);
    }

    public function testDelete()
    {
        $modelAuthor = factory(Author::class)->create();
        $response = $this->deleteJson(route('author.destroy', $modelAuthor));

        $response
            ->assertStatus(204);
    }
}
