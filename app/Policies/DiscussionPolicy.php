<?php

namespace App\Policies;

use App\User;
use App\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

        /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Discussion $discussion)
    {
        //
        return $user->id == $discussion->user_id;
    }

        /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Discussion $discussion)
    {
        //
        if($user->id == $discussion->user_id) {
            return $user->id == $discussion->user_id;
        } 
        if($user->hasAnyRoles(['owner', 'administrator', 'moderator'])) {
            return $user->hasAnyRoles(['owner', 'administrator', 'moderator']);
        }
    }
}
