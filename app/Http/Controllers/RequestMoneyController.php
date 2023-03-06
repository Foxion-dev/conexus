<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\Currency;
use App\Models\Office;
use App\Models\RequestMoney;
use App\Models\WorkDay;

class RequestMoneyController extends BaseController
{
    public function index()
    {
        $clients = RequestMoney::all();
        return view('requestMoney.index', compact('clients'));
    }

    public function create()
    {
        $currentOffice = WorkDay::find(auth()->user()->work_day_id)->officeDay->office;
        $offices = Office::all();
        $collectors = Collector::all();
        $currencies = Currency::all();

        return view('requestMoney.create', compact('currentOffice', 'offices', 'collectors', 'currencies'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'source_id' => '',
            'comment' => '',
            'person_photo' => '',
            'person_documents' => '',
        ]);

        if(isset($data['person_photo'])){
            $data['person_photo'] = str_replace('public/', '', $data['person_photo']->store('/public/upload/requestMoney'));
        }
        if(isset($data['person_documents'])){
            $data['person_documents'] = str_replace('public/', '', $data['person_documents']->store('/public/upload/requestMoney'));
        }

        $requestMoney = RequestMoney::create($data);

        return redirect()->route('index');
    }

    public function show(RequestMoney $requestMoney)
    {
        return view('requestMoney.show', compact('requestMoney'));
    }

    public function edit(RequestMoney $requestMoney)
    {
        $sources = Source::all();
        return view('requestMoney.edit', compact('requestMoney', 'sources'));
    }

    public function update(RequestMoney $requestMoney)
    {

        $data = request()->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'source_id' => '',
            'comment' => '',
            'person_photo' => '',
            'person_documents' => '',
        ]);

        if(isset($data['person_photo'])){
            $data['person_photo'] = str_replace('public/', '', $data['person_photo']->store('/public/upload/requestMoney'));
        }
        if(isset($data['person_documents'])){
            $data['person_documents'] = str_replace('public/', '', $data['person_documents']->store('/public/upload/requestMoney'));
        }

        $requestMoney->update($data);

        return redirect()->route('requestMoney.index');

    }

    public function delete(RequestMoney $requestMoney)
    {

        $requestMoney->delete();

        return redirect()->route('index');
    }

    public function destroy(RequestMoney $requestMoney)
    {

        $requestMoney->delete();

        return redirect()->route('index');
    }

    public function restore()
    {

        $requestMoney = RequestMoney::withTrashed()->find(2);
        $requestMoney->restore();

//        dd('restored');
    }

}
