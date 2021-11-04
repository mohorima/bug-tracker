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
            'bio' => $request->input('bio'),
            'photo' => $request->input('photo'),
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
            'bio' => $request->input('bio'),
            'photo' => $request->input('photo'),
            'role_id' => $request->input('role_id'),
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
    }

    public function updateProfile(UserRequest $request)
    {
        $user = auth('api')->user();
        $photoStr = $request->photo;

        //run only if incoming photo is not the same as the one saved in db
        if ($photoStr != $user->photo) {
            $semicolonPos = strpos($photoStr, ';');
            $photoExtension = substr($photoStr, 0, $semicolonPos);
            $name =
                time() .
                '.' .
                explode('/', explode(':', $photoExtension)[1])[1];

            \Image::make($photoStr)->save(
                public_path('images/profile/') . $name
            );
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
            'photo' => $name,
        ]);

        //$name is unique name for photo
        //time() function returns the current time in the number of seconds since the Unix Epoch
        //use Image Intervention package to convert photo string & save to folder public/images/profile/
        /*
        if request has photo
        explode() function converts a string to array, it takes two parameter
        explode('/', string) -->  split the string where there is '/' slash, and place each portion in array
        explode('/', string)[1] --> take first element in array
        substr('string', start, length) returns a part of a string
        substr('hello world',3) --> returns 'lo world' i.e. string starting from 3rd position
        substr('hello world', 0, 5) --> returns 'world' i.e. string starting from pos 0 and length 5
        strpos('string', 'i') --> find the position of the 1st occurence of 'i' in string, returns a num
        strpos($request->photo, ';') --> return position of first ; in photo string
        */
        /*
        //strpos($request->photo, ';') pos of 1st ; in photo string
        //substr($request->photo, 0, strpos($request->photo, ';')) portion of string from pos 0 to pos of first ;
        //explode(':',substr($request->photo, 0, strpos($request->photo, ';')))[1] split portion of string at : and take 1st element in array
        */
    }

    public function profile()
    {
        return auth('api')->user();
    }
}
