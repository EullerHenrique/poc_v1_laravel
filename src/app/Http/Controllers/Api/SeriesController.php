<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository)
    {

    }

    public function index()
    {
        return Serie::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $id)
    {
        $serie = Serie::whereId($id)->with('seasons.episodes')->first();
        if (is_null($serie)) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($serie);
    }

    public function update(int $id, SeriesFormRequest $request)
    {
        #Series::where(‘id’, $series)->update($request->all());
        $serie = Serie::find($id);
        if (is_null($serie)) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $serie->fill($request->all());
        $serie->save();
        return response()->json($serie);
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = Serie::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json(null, 200);
    }
}
