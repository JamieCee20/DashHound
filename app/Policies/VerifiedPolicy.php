<?php

namespace App\Policies;

use App\User;
use App\Verified;
use Illuminate\Auth\Access\HandlesAuthorization;

class VerifiedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Verified  $verified
     * @return mixed
     */
    public function view(User $user, Verified $verified)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Verified  $verified
     * @return mixed
     */
    public function update(User $user, Verified $verified)
    {
        //
        return $user->id == $verified->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Verified  $verified
     * @return mixed
     */
    public function delete(User $user, Verified $verified)
    {
        if($user->id == $verified->user_id) {
            return $user->id == $verified->user_id;
        }
        if($user->hasAnyRoles(['owner', 'administrator', 'moderator'])) {
            return $user->hasAnyRoles(['owner', 'administrator', 'moderator']);
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Verified  $verified
     * @return mixed
     */
    public function restore(User $user, Verified $verified)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Verified  $verified
     * @return mixed
     */
    public function forceDelete(User $user, Verified $verified)
    {
        //
    }
}
