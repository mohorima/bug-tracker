<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
        return $user->permissions->contains('view_all_project');
    }

    public function view(User $user, Project $project)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_project');
    }

    public function update(User $user, Project $project)
    {
        return $user->permissions->contains('update_project');
    }

    public function delete(User $user, Project $project)
    {
        return $user->permissions->contains('delete_project');
    }

    public function restore(User $user, Project $project)
    {
        //
    }

    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
