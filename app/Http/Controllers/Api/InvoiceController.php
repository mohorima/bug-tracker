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
        $this->authorize('viewAny', Invoice::class);

        $searchTerm = request('keywords');
        
        return Invoice::with('project')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(
                    'invoiceNum',
                    'LIKE',
                    '%' . $searchTerm . '%'
                );
            })
            ->latest()
            ->paginate(25);
    }

    public function store(InvoiceRequest $request)
    {
        $this->authorize('create', Invoice::class);

        $number = auth()->user()->id;
        $prefix = str_pad($number, 4, '0', STR_PAD_LEFT);

        return Invoice::create([
            'invoiceNum' => $prefix . random_int(100000, 999999),
            'billDate' => $request->input('billDate'),
            'dueDate' => $request->input('dueDate'),
            'amount' => $request->input('amount'),
            'paymentMode' => $request->input('paymentMode'),
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

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $invoice->update($request->all());
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        $invoice->delete();

        return ['msg' => 'Invoice deleted'];
    }
}
