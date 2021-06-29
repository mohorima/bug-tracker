<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
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
        $vendors = Vendor::latest()->paginate(25);

        return view('vendors.index', compact('vendors'));
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        return view('vendors.show', compact('vendor'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $this->createVendor($request);
        return redirect('/vendor/create')->with('message', 'New Vendor Added!');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);

        return view('vendors.edit', compact('vendor'));
    }

    public function update($id, VendorRequest $request)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect('/vendor');
    }

    private function createVendor(VendorRequest $request)
    {
        $vendor = Vendor::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'country' => $request->input('country'),
            'contactPerson' => $request->input('contactPerson'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
        ]);

        return $vendor;
    }
}
