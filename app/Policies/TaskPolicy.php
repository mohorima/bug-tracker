<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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
        return $user->permissions->contains('view_all_task');
    }

    public function view(User $user, Task $task)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_task');
    }

    public function update(User $user, Task $task)
    {
        return $user->permissions->contains('update_task') ||
            $task->user_id == auth('api')->id() ||
            $task->collaborator_id == auth('api')->id();
    }

    public function delete(User $user, Task $task)
    {
        return $user->permissions->contains('delete_task');
    }

    public function restore(User $user, Task $task)
    {
        //
    }

    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
