<?php

namespace App\Policies;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DosenPolicy
{
    public function modify(User $user, Dosen $dosen): Response
    {
        return $user->id === $dosen->user_id
            ? Response::allow()
            : Response::deny('Anda bukan pemilik data ini');
    }
}