<?php

namespace App;

use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates =['dataDaUltimaContribuicao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacosas() {
        return $this->hasMany('App\Vacosa', 'organizador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contribuicoes()
    {
        return $this->hasMany('App\Contribuicao', 'participante_id');
    }

    /**
     * @return string
     */
    public function getTypeAttribute()
    {
        if ($this->role == 'admin') {
            return 'administrador';
        }

        return 'usuário';
    }

    /**
     * @return string
     */
    public function getPhoneAttribute($number)
    {
        $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
        // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
        return $number;
    }
/**
     * @return string
     */
    public function setPhoneAttribute($value)
    {
        $tel = preg_replace("/[^0-9]/", "", $value);
        $this->attributes['phone'] = $tel;
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->blocked == false) {
            return 'ativo';
        }

        return 'bloqueado';
    }

    /**
     * @return int
     */
    public function getTotalContribuidoAttribute()
    {
        $total = 0;

        foreach ($this->contribuicoes as $contribuicao) {
            $total += $contribuicao->valor;
        }

        return $total;
    }

    /**
     * @return mixed
     */
    public function getDataDaUltimaContribuicaoAttribute()
    {
        if (! $this->contribuicoes->last()) {
            return '';
        }

        return $this->contribuicoes->last()->created_at;
    }

    /**
     * @return bool
     */
    public function setAsAdmin()
    {
        $this->role = 'admin';
        return $this->save();
    }

    /**
     * @return bool
     */
    public function setAsUser()
    {
        $this->role = 'user';
        return $this->save();
    }

    /**
     * @return bool
     */
    public function block()
    {
        $this->blocked = true;
        return $this->save();
    }

    /**
     * @return bool
     */
    public function unblock()
    {
        $this->blocked = false;
        return $this->save();
    }
}
