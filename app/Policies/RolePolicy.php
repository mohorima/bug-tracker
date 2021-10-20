<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return $user->permissions->contains('view_all_role');
    }

    public function view(User $user, Role $role)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_role');
    }

    public function update(User $user, Role $role)
    {
        return $user->permissions->contains('update_role');
    }

    public function delete(User $user, Role $role)
    {
        return $user->permissions->contains('delete_role');
    }

    public function restore(User $user, Role $role)
    {
        //
    }

    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
