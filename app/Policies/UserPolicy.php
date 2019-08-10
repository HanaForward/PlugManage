<?php

namespace App\Policies;

use App\Models\User;
use App\updata;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->hasRole('Founder')) {
            return true;
        }
    }


    /**
     * Determine whether the user can view any updatas.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the updata.
     *
     * @param  \App\Models\User  $user
     * @param  \App\updata  $updata
     * @return mixed
     */
    public function view(User $user, updata $updata)
    {
        //
    }

    /**
     * Determine whether the user can create updatas.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {


    }

    /**
     * Determine whether the user can update the updata.
     *
     * @param  \App\Models\User  $user
     * @param  \App\updata  $updata
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
