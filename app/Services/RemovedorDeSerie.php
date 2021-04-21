<?php

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        
        // DB::transaction(function () use ($serieId, &$nomeSerie){
            DB::beginTransaction();
            $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;
        $serie->temporadas->each(function (Temporada $temporada){
            $temporada->episodios->each(function (Episodio $episodio){
                $episodio->delete();
            });
            $temporada->delete();
        });
        $serie->delete();
        DB::commit();
        

        return $nomeSerie;
    }

}