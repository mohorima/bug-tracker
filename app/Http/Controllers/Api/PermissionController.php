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
        return Permission::latest()->paginate(20);
    }

    public function store(PermissionRequest $request)
    {
        return Permission::create([
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }
}
