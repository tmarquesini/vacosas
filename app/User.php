<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

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
     * @return Carbon
     */
    public function getDataDaUltimaContribuicaoAttribute()
    {
        return new Carbon(now());
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
