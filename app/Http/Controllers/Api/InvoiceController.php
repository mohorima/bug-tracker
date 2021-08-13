<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Invoice::with('project')
            ->latest()
            ->paginate(25);
    }

    public function store(InvoiceRequest $request)
    {
        return Invoice::create([
            'billDate' => $request->input('billDate'),
            'dueDate' => $request->input('dueDate'),
            'tax' => $request->input('tax'),
            'recurring' => $request->input('recurring'),
            'note' => $request->input('note'),
            'project_id' => $request->input('project_id'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return ['msg' => 'Invoice deleted'];
    }
}
