<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::all();
        $mensagemSucesso = session('mensagem.sucesso');
        return view(   'series.index')
        ->with('series', $series)
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        #DB:transacion() -> União dos comandos abaixo
        #DB:beginTransaction()
        #DB::commit()
        #DB::rollBack()
        $serie = DB::transaction(function () use ($request) {
            #Opção 1
            #$serie = new Serie();
            #$serie->name = $request->name;
            #$serie->save();

            #Opção 2 (Precisa adicionar fillable no model)
            $serie = Serie::create(['name' => $request->name]);

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
       
        return to_route('series.index')
        ->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso");
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        return to_route('series.index')
        ->with('mensagem.sucesso', 'Série removida com sucesso');
    }

    public function edit(Request $request)
    {
        $serie = Serie::find($request->id);
        return view('series.edit')->with('serie', $serie);
    }

    public function update(SeriesFormRequest $request)
    {
        $serie = Serie::find($request->id);
        $serie->name = $request->name;
        $serie->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série atualizada com sucesso");
    }
}
