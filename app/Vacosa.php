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
        'organizador', 'nome', 'descricao', 'valor', 'url'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizador() {
        return $this->belongsTo('App\User', 'id', 'organizador');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantes() {
        return $this->hasMany('App\User', 'participante');
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
