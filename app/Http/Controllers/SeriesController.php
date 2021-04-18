<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series','mensagem'));
    }
    public function create() {
        return view('series.create');
    }
    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        $request->session()->flash(
            'mensagem',
            "Série com id {$serie->id} criada com sucesso {$serie->nome}"
        );
        return redirect()->route('listar_series');
        echo "Série com id {$serie->id} criada: {$serie->nome}";
    }
    public function destroy(Request $request)
    {
        Serie::destroy($request->id);

        $request->session()->flash(
            'mensagem',
            "Série removida com sucesso!"
        );
        return redirect()->route('listar_series');
    }
}
