<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\WorkDay;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expense.index', compact('expenses'));
    }

    public function create()
    {

        $workDay = WorkDay::find(auth()->user()->work_day_id);
        $currencies = Currency::all();

        return view('expense.create', compact('workDay', 'currencies'));
    }

    public function store()
    {
        $data = request()->validate([
            'amount' => 'required|integer',
            'currency_id' => 'required|integer',
            'work_day_id' => '',
            'comment' => '',
        ]);

        $expense = Expense::create($data);

        return redirect()->route('index');
    }

    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $currencies = Currency::all();

        return view('expense.edit', compact('expense','currencies'));
    }

    public function update(Expense $expense)
    {

        $data = request()->validate([
            'amount' => '',
            'currency_id' => '',
            'comment' => '',
        ]);

        $expense->update($data);

        return redirect()->route('index');

    }

    public function delete(Expense $expense)
    {

        $expense->delete();

        return redirect()->route('index');
    }

    public function destroy(Expense $expense)
    {

        $expense->delete();

        return redirect()->route('index');
    }

    public function restore()
    {

        $expense = Expense::withTrashed()->find(2);
        $expense->restore();

//        dd('restored');
    }

}
