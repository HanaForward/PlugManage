<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ShopPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('Founder')) {
            return true;
        }
    }


    public function view(User $user)
    {
        if ($user->hasRole('Development')) {
            return true;
        }
    }

    public function create(User $user)
    {

    }
    public function update(User $user)
    {

    }
}
