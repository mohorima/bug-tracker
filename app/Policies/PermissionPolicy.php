<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    //ONLY ADMIN CAN MANIPULATE PERMISSIONS

    public function before(User $user)
    {
        return $user->role_id == Role::IS_ADMIN;
    }

    public function viewAny(User $user)
    {
        //return $user->permissions->contains('view_all_permission');
    }

    public function view(User $user, Permission $permission)
    {
        //
    }

    public function create(User $user)
    {
        //return $user->permissions->contains('create_permission');
    }

    public function update(User $user, Permission $permission)
    {
        //return $user->permissions->contains('update_permission');
    }

    public function delete(User $user, Permission $permission)
    {
        //return $user->permissions->contains('delete_permission');
    }

    public function restore(User $user, Permission $permission)
    {
        //
    }

    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
