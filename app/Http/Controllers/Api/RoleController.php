<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $searchTerm = request('keywords');

        $role = Role::orderBy('id', 'ASC')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        return response()->json([
            'roles' => $role,
        ]);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);

        return Role::create($request->all());
    }

    public function show($id)
    {
        //
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->update($request->all());
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
    }
}
