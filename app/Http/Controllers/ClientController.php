<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        $clients = Client::latest()->paginate(25);

        return view('clients.index', compact('clients'));
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.show', compact('client'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(ClientRequest $request)
    {
        $this->createClient($request);
        return redirect('/client/create')->with('message', 'New Client Added!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit', compact('client'));
    }

    public function update($id, ClientRequest $request)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('/client');
    }

    private function createClient(ClientRequest $request)
    {
        $client = Client::create([
            'company' => $request->input('company'),
            'owner' => $request->input('owner'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'country' => $request->input('country'),
            'contactPerson' => $request->input('contactPerson'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'clientGroup' => $request->input('clientGroup'),
            'vatNumber' => $request->input('vatNumber'),
            'billingAddress' => $request->input('billingAddress'),
            'billingCity' => $request->input('billingCity'),
            'billingState' => $request->input('billingState'),
            'billingZip' => $request->input('billingZip'),
            'billingCountry' => $request->input('billingCountry'),
        ]);

        return $client;
    }
}
