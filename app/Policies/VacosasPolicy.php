<?php

namespace App\Policies;

use App\User;
use App\Vacosa;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class VacosasPolicy
 * @package App\Policies
 */
class VacosasPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the vacosa.
     *
     * @param  \App\User  $user
     * @param  \App\Vacosa  $vacosa
     * @return mixed
     */
    public function view(User $user, Vacosa $vacosa)
    {
        return true;
    }

    /**
     * Determine whether the user can create vacosas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the vacosa.
     *
     * @param  \App\User  $user
     * @param  \App\Vacosa  $vacosa
     * @return mixed
     */
    public function update(User $user, Vacosa $vacosa)
    {
        return $vacosa->organizador->id == $user->id;
    }

    /**
     * Determine whether the user can delete the vacosa.
     *
     * @param  \App\User  $user
     * @param  \App\Vacosa  $vacosa
     * @return mixed
     */
    public function delete(User $user, Vacosa $vacosa)
    {
        return false;
    }
}
