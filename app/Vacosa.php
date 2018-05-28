<?php

namespace App;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vacosa
 * @package App
 */
class Vacosa extends Model
{
    use Uuids;
    /**
     * @var array
     */
    protected $fillable = [
        'organizador_id', 'nome', 'descricao', 'valor', 'url'
    ];

    public function scopeAbertas($q)
    {
        return $q->where("status","aberta")->orderBy('created_at', 'desc');
    }

    public function scopeFechadas($q)
    {
        return $q->where("status", "fechada")->orderBy('created_at', 'desc');
    }

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
     * @return int
     */
    public function getTotalArrecadadoAttribute()
    {
        $total = 0;

        foreach ($this->contribuicoes as $contribuicao) {
            $total += $contribuicao->valor;
        }

        return $total;
    }

    /**
     * @return bool
     */
    public function fechar()
    {
        $this->status = 'fechada';
        return $this->save();
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->getTotalArrecadadoAttribute() >= $this->valor) {
            return 'fechada';
        }

        return 'aberta';
    }
}
