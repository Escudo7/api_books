<?php

namespace Tests\Unit;

use App\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $genres = factory(Genre::class, 2)->create();
        $response = $this->getJson(route('genres.index'));

        $expectedJson = array_map(function ($genre) {
            return array_filter($genre, function ($key) {
                return $key !== 'updated_at' && $key !== 'created_at';
            }, ARRAY_FILTER_USE_KEY);
        }, $genres->toArray());

        $response
            ->assertStatus(200)
            ->assertExactJson($expectedJson);

    }

    public function testStore()
    {
        $modelGenre = factory(Genre::class)->make();
        $response = $this->postJson(route('genres.store'), $modelGenre->toArray());

        $expectedJson = array_merge($modelGenre->toArray(), ['id' => 1]);
        $response
            ->assertStatus(201)
            ->assertExactJson($expectedJson);
        $this->assertEquals(1, Genre::where('name', $modelGenre->name)->count());
    }

    public function testUpdate()
    {
        $modelGenre = factory(Genre::class)->create();
        $dataForUpdate = factory(Genre::class)->make()->toArray();
        $response = $this->patchJson(route('genres.update', $modelGenre->id), $dataForUpdate);

        $expectedJson = array_merge($dataForUpdate, ['id' => $modelGenre->id]);
        $response
            ->assertStatus(200)
            ->assertExactJson($expectedJson);
        $this->assertEquals(1, Genre::where('name', $dataForUpdate['name'])->count());
    }

    public function testDelete()
    {
        $modelGenre = factory(Genre::class)->create();
        $response = $this->deleteJson(route('genres.destroy', $modelGenre));

        $response
            ->assertStatus(204);
    }
}
