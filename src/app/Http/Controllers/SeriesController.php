<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Events\SeriesCreated as SeriesCreatedEvent;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index()
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
        $coverPath = $request->file('cover')->store('series_cover', 'public');
        $request->merge(['coverPath' => $coverPath]);
        $serie = $this->seriesRepository->add($request);
        SeriesCreatedEvent::dispatch($serie->name, $serie->id, $request->seasonsQty, $request->episodesPerSeason);
        #event(new SeriesCreated($serie->name, $serie->id, $serie->seasons_qty, $serie->episodes_per_season));
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
