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
        $role = Role::orderBy('id', 'ASC')->get();

        return response()->json([
            'roles' => $role,
        ]);
    }

    public function store(RoleRequest $request)
    {
        return Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
