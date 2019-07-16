<?php

namespace App\Policies;

use App\User;
use App\Group;
use App\Workshop;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkshopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the workshop.
     *
     * @param  \App\User  $user
     * @param  \App\Workshop  $workshop
     * @return mixed
     */
    public function view(?User $user, Workshop $workshop)
    {
        if ($workshop->public || ($user && $workshop->sharesGroupWith($user, true))) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create workshops.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(?User $user)
    {
        // If there is a request for creating a workshop, for a group that the user is not a member of, block it.
        // Prevents people editing the group id value in the form to a group id that they have no authorization for.
        if (!$user ||
            (request() && !$user->groups()->get()->contains(Group::where('id', request()->get('group'))->first()))
        ) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can update the workshop.
     *
     * @param  \App\User  $user
     * @param  \App\Workshop  $workshop
     * @return mixed
     */
    public function update(User $user, Workshop $workshop)
    {
        return $user->owns($workshop);
    }

    /**
     * Determine whether the user can delete the workshop.
     *
     * @param  \App\User  $user
     * @param  \App\Workshop  $workshop
     * @return mixed
     */
    public function delete(User $user, Workshop $workshop)
    {
        return $user->owns($workshop);
    }

    /**
     * Determine whether the user can restore the workshop.
     *
     * @param  \App\User  $user
     * @param  \App\Workshop  $workshop
     * @return mixed
     */
    public function restore(User $user, Workshop $workshop)
    {
        return $user->owns($workshop);
    }

    /**
     * Determine whether the user can permanently delete the workshop.
     *
     * @param  \App\User  $user
     * @param  \App\Workshop  $workshop
     * @return mixed
     */
    public function forceDelete(User $user, Workshop $workshop)
    {
        return $user->owns($workshop);
    }
}
