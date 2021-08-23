<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function create(User $user)
    {
        return Auth::user() == null ? false : true;
    }
}
