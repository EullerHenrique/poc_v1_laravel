<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeasonsController extends Controller
{
    public function index(Request $request)
    {
        #Faz o lazy loading, busca a série e depois busca todas as temporadas dela e seus episódios, ou seja, somente quando necessário (Três consultas)
        #Opção 1 (With)
        $serie = Serie::find($request->id);
        $seasons = $serie->seasons()->with('episodes')->get();
        
        #Opção 2 (Load)
        #$serie = Serie::find($request->id);
        #$serie->load('seasons.episodes');
        #$seasons = $serie->seasons;

        #Faz o eager loading, busca a série e busca todas as temporadas dela e seus episódios, ou seja, de uma vez (Três consultas)
        #Opção 1 (With)
        #$serie = Serie::with('seasons.episodes')->find($request->id);
        #$seasons = $serie->seasons;

        #Opção 2 (Load)
        #$serie = Serie::find($request->id)->load('seasons.episodes');
        #$seasons = $serie->seasons;
       
        return view('seasons.index')
        ->with('seasons', $seasons)
        ->with('serie', $serie);
    }
}
