<?php

namespace Tests\Feature;

use App\Repositories\EloquentSeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\SeriesFormRequest;


class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_when_a_series_is_created_its_seasons_and_episodes_must(){
        $repository = $this->app->make(EloquentSeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->name = 'Teste';
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        $repository->add($request);

        $this->assertDatabaseHas('series', [
            'name' => 'Teste'
        ]);
        $this->assertDatabaseHas('seasons', [
            'number' => 1,
        ]);
        $this->assertDatabaseHas('episodes', [
            'number' => 1,
        ]);

    }
}
