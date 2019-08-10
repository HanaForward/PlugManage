<?php

namespace App\Policies;

use App\Models\Token;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('Founder')) {
            return true;
        }
    }


    public function update(User $currentUser, Token $token)
    {
        return $currentUser->id === $token->user_id;
    }
}
