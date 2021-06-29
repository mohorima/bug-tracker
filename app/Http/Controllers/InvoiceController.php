<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $invoices = Invoice::latest()->paginate(25);

        return view('invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(InvoiceRequest $request)
    {
        $this->createInvoice($request);
        return redirect('/invoice/create')->with('message', 'New Invoice Added!');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.edit', compact('invoice'));
    }

    public function update($id, InvoiceRequest $request)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect('/invoice');
    }

    private function createInvoice(InvoiceRequest $request)
    {
        $invoice = Invoice::create([
            'billDate' => $request->input('billDate'),
            'dueDate' => $request->input('dueDate'),
            'tax' => $request->input('tax'),
            'recurring' => $request->input('recurring'),
            'note' => $request->input('note'),
            'tags' => $request->input('tags'),
            'project_id' => $request->input('project_id'),
        ]);

        return $invoice;
    }
}
