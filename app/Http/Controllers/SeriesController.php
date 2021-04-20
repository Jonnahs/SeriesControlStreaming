<?php

namespace App\Http\Controllers;

use App\Services\CriadorDeSerie;
use App\Http\Requests\SeriesRequest;
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

    public function store(SeriesRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada

        );

        $request->session()->flash(
            'mensagem',
            "Série com id {$serie->id} e suas temporadas e episódios criados com sucesso {$serie->nome}"
        );
        return redirect()->route('listar_series');
        echo "Série com id {$serie->id} criada: {$serie->nome}";
    }

    public function destroy(Request $request)
    {
        //Serie::destroy($request->id);

        $serie = Serie::find($request->id);
        $nomeSerie = $serie->nome;
        $serie->temporadas->each(function (Temporada $temporada){
            $temporada->episodios->each(function (Episodio $episodio){
                $episodio->delete();
            });
            $temporada->delete();
        });
        $serie->delete();
        $request->session()->flash(
            'mensagem',
            "Série $nomeSerie removida com sucesso!"
        );
        return redirect()->route('listar_series');
    }
}
