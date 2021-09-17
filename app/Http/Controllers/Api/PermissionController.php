<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        $searchTerm = request('keywords');

        return Permission::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('slug', 'LIKE', '%' . $searchTerm . '%');
        })
            ->latest()
            ->paginate(20);
    }

    public function store(PermissionRequest $request)
    {
        $this->authorize('create', Permission::class);

        return Permission::create($request->all());
    }

    public function show($id)
    {
        //
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $permission->update($request->all());
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        $permission->delete();
    }
}
