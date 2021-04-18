<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index() {
        $series = Serie::query()->orderBy('nome')->get();
        return view('series.index', compact('series'));
    }
    public function create() {
        return view('series.create');
    }
    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        return redirect('/series');
        echo "Série com id {$serie->id} criada: {$serie->nome}";


    }
}
