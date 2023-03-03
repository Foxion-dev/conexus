<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\Currency;
use App\Models\Encashment;
use App\Models\EncashmentType;
use App\Models\WorkDay;
use Illuminate\Http\Request;

class EncashmentController extends Controller
{
    public function index()
    {
        $expenses = EncashmentController::all();
        return view('encashment.index', compact('expenses'));
    }

    public function create()
    {

        $workDay = WorkDay::find(auth()->user()->work_day_id);
        $currencies = Currency::all();
        $collectors = Collector::all();
        $types = EncashmentType::all();

        return view('encashment.create', compact('workDay', 'currencies', 'collectors','types'));
    }

    public function store()
    {
        $data = request()->validate([
            'type_id' => 'required|integer',
            'amount' => 'required|integer',
            'currency_id' => 'required|integer',
            'collector_id' => 'required|integer',
            'work_day_id' => '',
        ]);

        $encashment = Encashment::create($data);

        return redirect()->route('index');
    }

    public function show(Encashment $encashment)
    {
        return view('encashment.show', compact('encashment'));
    }

    public function edit(Encashment $encashment)
    {
        $currencies = Currency::all();
        $collectors = Collector::all();
        $types = EncashmentType::all();

        return view('encashment.edit', compact('encashment', 'currencies', 'collectors','types'));
    }

    public function update(Encashment $encashment)
    {

        $data = request()->validate([
            'type_id' => 'required|integer',
            'amount' => 'required|integer',
            'currency_id' => 'required|integer',
            'collector_id' => 'required|integer',
        ]);

        $encashment->update($data);

        return redirect()->route('index');

    }

    public function delete(Encashment $encashment)
    {

        $encashment->delete();

        return redirect()->route('index');
    }

    public function destroy(Encashment $encashment)
    {

        $encashment->delete();

        return redirect()->route('index');
    }

    public function restore()
    {

        $encashment = Encashment::withTrashed()->find(2);
        $encashment->restore();

//        dd('restored');
    }
}
