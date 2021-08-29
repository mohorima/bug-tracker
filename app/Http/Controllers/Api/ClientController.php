<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $searchTerm = request('keywords');
        return Client::when($searchTerm, function ($query, $searchTerm) {
            return $query
                ->where('company', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('owner', 'LIKE', '%' . $searchTerm . '%');
        })
            ->latest()
            ->paginate(25);
    }

    public function store(ClientRequest $request)
    {
        return Client::create([
            'company' => $request->input('company'),
            'owner' => $request->input('owner'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'contactPerson' => $request->input('contactPerson'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return ['msg' => 'Client deleted'];
    }
}
