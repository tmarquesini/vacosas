<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UsersPolicy
 * @package App\Policies
 */
class UsersPolicy
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
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $model->vacosas->count == 0 && $model->contribuicoes->count() == 0;
    }

    /**
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function setBlock(User $user, User $model)
    {
        return false;
    }

    /**
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function setType(User $user, User $model)
    {
        return false;
    }
}
