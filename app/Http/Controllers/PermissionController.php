<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::latest()->paginate(20);

        return view('permissions.index', compact('permissions'));
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permissions.show', compact('permission'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->createPermission($request);
        return redirect('/permission/create')->with(
            'message',
            'New Permission Added!'
        );
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permissions.edit', compact('permission'));
    }

    public function update($id, PermissionRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect('/permission');
    }

    private function createPermission(PermissionRequest $request)
    {
        $permission = Permission::create([
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        return $permission;
    }
}
