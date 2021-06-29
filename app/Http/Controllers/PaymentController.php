<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        $payments = Payment::latest()->paginate(25);

        return view('payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('payments.show', compact('payment'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(PaymentRequest $request)
    {
        $this->createPayment($request);
        return redirect('/payment/create')->with(
            'message',
            'New Payment Added!'
        );
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        return view('payments.edit', compact('payment'));
    }

    public function update($id, PaymentRequest $request)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect('/payment');
    }

    private function createPayment(PaymentRequest $request)
    {
        $payment = Payment::create([
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'paymentMode' => $request->input('paymentMode'),
            'description' => $request->input('description'),
            'invoice_id' => $request->input('invoice_id'),
        ]);

        return $payment;
    }
}
