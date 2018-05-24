<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vacosa
 * @package App
 */
class Vacosa extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'organizador_id', 'nome', 'descricao', 'valor', 'url'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizador() {
        return $this->belongsTo('App\User', 'organizador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contribuicoes() {
        return $this->hasMany('App\Contribuicao', 'vacosa_id');
    }

    /**
     * @return bool
     */
    public function fechar()
    {
        $this->status = 'fechada';
        return $this->save();
    }
}
