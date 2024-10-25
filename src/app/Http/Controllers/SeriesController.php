<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

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
        $serie = $this->seriesRepository->add($request);
        
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreated(
                $serie->name,
                $serie->id,
                $request->seasonsQty,
                $request->episodesPerSeason
            );
            #$when = now()->addSeconds($index * 5);
            #Mail::to($user)->later($when, $email);
            Mail::to($user)->queue($email);
        }
   
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
