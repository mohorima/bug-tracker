<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
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
        return $user->permissions->contains('view_all_issue');
    }

    public function view(User $user, Issue $issue)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_issue');
    }

    public function update(User $user, Issue $issue)
    {
        return $user->permissions->contains('update_issue') ||
            $issue->user_id == auth('api')->id() ||
            $issue->assignee_id == auth('api')->id();
    }

    public function delete(User $user, Issue $issue)
    {
        return $user->permissions->contains('delete_issue');
    }

    public function restore(User $user, Issue $issue)
    {
        //
    }

    public function forceDelete(User $user, Issue $issue)
    {
        //
    }
}
