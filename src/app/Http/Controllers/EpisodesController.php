<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class EpisodesController
{
    public function index(Request $request)
    {
        $episodes = Season::find($request->id)->episodes;
        return view('episodes.index', [
            'episodes' => $episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
         ]);
    }

    public function update(Request $request)
    {
        $watchedEpisodes = implode(', ', $request->episodes ?? []);
        $season = Season::find($request->id);
        if (empty($watchedEpisodes)) {
            DB::transaction(function () use ($season) {
                $season->episodes()->update(['watched' => 0]);
            });
        }else{
            DB::transaction(function () use ($watchedEpisodes, $season) {
                $season->episodes()->update(['watched' => DB::raw("case when id in ($watchedEpisodes) then 1 else 0 end")]); 
            });
        }
        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', 'Status dos episódios atualizado com sucesso');
    }
}

