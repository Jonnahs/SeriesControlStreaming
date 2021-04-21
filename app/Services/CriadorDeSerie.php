<?php

namespace App\Services;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada
        ): Serie
    {
        $serie = '';
        DB::transaction(function () use ($qtdTemporadas,$epPorTemporada, $nomeSerie, &$serie){
            $serie = Serie::create(['nome' => $nomeSerie]);
        // $qtdTemporadas = $request->qtd_temporadas;
        for ($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++){
                $temporada->episodios()->create(['numero' => $j]);
            }
        }
        
        });
        return $serie;
        
    }
}