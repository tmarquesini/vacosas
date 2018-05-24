<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contribuicao
 * @package App
 */
class Contribuicao extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'vacosa', 'participante', 'valor'
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
