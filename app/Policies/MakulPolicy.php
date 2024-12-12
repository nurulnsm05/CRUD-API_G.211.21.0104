<?php

namespace App\Policies;

use App\Models\User;
use App\Models\makul;
use Illuminate\Auth\Access\Response;

class MakulPolicy
{
    public function modify(User $user, makul $makul): Response
    {
        return $user->id === $makul->user_id
            ? Response::allow()
            : Response::deny('Anda bukan pemilik data ini');
    }
}