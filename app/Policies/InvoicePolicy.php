<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
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
        return $user->permissions->contains('view_all_invoice');
    }

    public function view(User $user, Invoice $invoice)
    {
        //
    }

    public function create(User $user)
    {
        return $user->permissions->contains('create_invoice');
    }

    public function update(User $user, Invoice $invoice)
    {
        return $user->permissions->contains('update_invoice');
    }

    public function delete(User $user, Invoice $invoice)
    {
        return $user->permissions->contains('delete_invoice');
    }

    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }
}
