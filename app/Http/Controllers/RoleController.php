<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles = Role::orderBy('id', 'ASC')->paginate(25);

        return view('roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(RoleRequest $request)
    {
        $this->createRole($request);
        return redirect('/role/create')->with('message', 'New Role Added!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.edit', compact('role'));
    }

    public function update($id, RoleRequest $request)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/role');
    }

    private function createRole(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return $role;
    }

}
