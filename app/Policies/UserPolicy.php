<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->role_id == Role::IS_ADMIN) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->permissions->contains('view_all_user');
    }

    public function view(User $user, User $model)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_user');
    }

    public function update(User $user, User $model)
    {
        return $user->permissions->contains('update_user');
    }

    public function delete(User $user, User $model)
    {
        return $user->permissions->contains('delete_user');
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
