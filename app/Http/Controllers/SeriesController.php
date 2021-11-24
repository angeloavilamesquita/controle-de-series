<?php

namespace App\Http\Controllers;

use App\Http\Requests\Serie\StoreSerieRequest;
use App\Http\Requests\Serie\UpdateSerieRequest;
use App\Models\Serie;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
    public function index(): Response
    {
        return response(Serie::with('temporadas')->get(), Response::HTTP_OK);
    }

    public function store(StoreSerieRequest $request): Response
    {
        $serieCadastrada = Serie::create($request->all());
        return response($serieCadastrada, Response::HTTP_CREATED);
    }

    public function show(int $id): Response
    {
       $serie = Serie::findOrFail($id);
       return response($serie, Response::HTTP_OK);
    }

    public function update(UpdateSerieRequest $request, int $id): Response
    {
        $serie = Serie::find($id);
        $serie->fill($request->all());
        $serie->update();
        return response('No Content', Response::HTTP_NO_CONTENT);
    }

    public function status(int $id): Response
    {
        $serie = Serie::find($id);
        $serie->alternarStatus();
        $serie->save();
        return response('No Content', Response::HTTP_NO_CONTENT);
    }

    public function destroy(int $id): Response
    {
        Serie::destroy($id);
        return response('OK', Response::HTTP_OK);
    }
}
