<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MahasiswaPolicy
{
    public function modify(User $user, Mahasiswa $mahasiswa): Response
    {
        return $user->id === $mahasiswa->user_id
            ? Response::allow()
            : Response::deny('Anda bukan pemilik data ini');
    }
}