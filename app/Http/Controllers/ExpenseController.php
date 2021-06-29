<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
        $expenses = Expense::latest()->paginate(25);

        return view('expenses.index', compact('expenses'));
    }

    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.show', compact('expense'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(ExpenseRequest $request)
    {
        $this->createExpense($request);
        return redirect('/expense/create')->with(
            'message',
            'New Expense Added!'
        );
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    public function update($id, ExpenseRequest $request)
    {
        $expense = Expense::findOrFail($id);
        $expense->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect('/expense');
    }

    private function createExpense(ExpenseRequest $request)
    {
        $expense = Expense::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'paymentMode' => $request->input('paymentMode'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'vendor_id' => $request->input('vendor_id'),
        ]);

        return $expense;
    }
}
