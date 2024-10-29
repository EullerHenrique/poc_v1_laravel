<?php

namespace App\Repositories;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Episode;

class EloquentSeriesRepository implements SeriesRepository
{
   public function add(SeriesFormRequest $request): Serie
   {
    #DB:transacion() -> União dos comandos abaixo
    #DB:beginTransaction()
    #DB::commit()
    #DB::rollBack()
    return DB::transaction(function () use ($request) {
        #Opção 1
        #$serie = new Serie();
        #$serie->name = $request->name;
        #$serie->save();

        #Opção 2 (Precisa adicionar fillable no model)
        $serie = Serie::create([
            'name' => $request->name,
            'cover' => $request->coverPath
            
        ]);

        #Opção 3 (Todos os campos do request precisam estar no fillable do model)
        #$serie = Serie::create($request->all());

        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'serie_id' => $serie->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);
        return $serie;
    });
   }
}

