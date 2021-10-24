<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $searchTerm = request('keywords');

        return User::with('role')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query
                    ->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->latest()
            ->paginate(25);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
    }

    public function profile()
    {
        return auth('api')->user();
        // return User::where('id', auth('api')->id())
        //     ->with('role')
        //     ->get();
    }

    public function updateProfile(UserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
        ]);
    }
}
