<?php

namespace App\Policies;

use App\Models\ObjectModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Object $object)
    {
        return $user->id === $object->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Object $object)
    {
        return $user->id === $object->user_id;
    }

    public function delete(User $user, Object $object)
    {
        return $user->id === $object->user_id;
    }
}
