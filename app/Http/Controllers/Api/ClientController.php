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
        $this->authorize('viewAny', Client::class);

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
        $this->authorize('create', Client::class);
        return Client::create($request->all());
    }

    public function show($id)
    {
        //
    }

    public function update(ClientRequest $request, Client $client)
    {
        $this->authorize('update', $client);
        $client->update($request->all());
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();

        return ['msg' => 'Client deleted'];
    }
}
