<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role_id == Role::IS_ADMIN;
    }

    public function view(User $user, Role $role)
    {
        //
    }

    public function create(User $user)
    {
        return $user->role_id == Role::IS_ADMIN;
    }

    public function update(User $user, Role $role)
    {
        return $user->role_id == Role::IS_ADMIN;
    }

    public function delete(User $user, Role $role)
    {
        return $user->role_id == Role::IS_ADMIN;
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
