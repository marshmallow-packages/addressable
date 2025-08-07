<?php

namespace Marshmallow\Addressable\Policies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any support tickets.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function viewAny(Authenticatable $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the support ticket.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function view(Authenticatable $user, Model $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create support tickets.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(Authenticatable $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the support ticket.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function update(Authenticatable $user, Model $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the support ticket.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function delete(Authenticatable $user, Model $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the support ticket.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function restore(Authenticatable $user, Model $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the support ticket.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function forceDelete(Authenticatable $user, Model $model)
    {
        return true;
    }
}
