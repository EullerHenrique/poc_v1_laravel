<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name')->get();
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
        $nomeSerie = $request->name;

        #Serie::create(['name' => $nomeSerie]); //Adicionar fillable no model
        #Series::create($request->all()); //Adicionar fillable no model

        $serie = new Serie();
        $serie->name = $nomeSerie;
        $serie->save();
    
        return to_route('series.index')
        ->with('mensagem.sucesso', 'Série adicionada com sucesso');
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
