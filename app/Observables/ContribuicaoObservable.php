<?php
/**
 * Created by PhpStorm.
 * User: geordehenrique
 * Date: 28/05/2018
 * Time: 16:24
 */

namespace App\Observables;


use App\Contribuicao;
use App\Vacosa;

class ContribuicaoObservable
{

    public function created(Contribuicao $contribuicao)
    {
        $vacosa = Vacosa::find($contribuicao->vacosa_id);
        $totalContribuicoes = $vacosa->totalArrecadado;

        if($totalContribuicoes >= $vacosa->valor){
            $vacosa->status = "fechada";
            $vacosa->save();
        }

    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(Contribuicao $user)
    {
        //
    }

}