<?php

namespace App;

use App\Observables\ContribuicaoObservable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contribuicao
 * @package App
 */
class Contribuicao extends Model
{
    /**
     * @var string
     */
    protected $table = 'contribuicoes';

    /**
     * @var array
     */
    protected $fillable = [
        'vacosa_id', 'participante_id', 'valor'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vacosa()
    {
        return $this->belongsTo('App\Vacosa', 'vacosa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participante()
    {
        return $this->belongsTo('App\User', 'participante_id');
    }
}
