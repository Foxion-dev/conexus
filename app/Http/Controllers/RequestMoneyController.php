<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\Currency;
use App\Models\Office;
use App\Models\RequestMoney;
use App\Models\WorkDay;

class RequestMoneyController extends BaseController
{

    protected $cashCurrency = [1,2,4];
    protected $currentWorkDay;
    protected $currentOffice;

    public function setProperties()
    {
        $this->currentWorkDay = WorkDay::find(auth()->user()->work_day_id);
        $this->currentOffice = Office::find($this->currentWorkDay->officeDay->office->id);

    }

    public function index()
    {
        $this->setProperties();

        $requests['inside'] = RequestMoney::latest()->where(['request_office_id' => $this->currentOffice->id])->get();
        $requests['outside'] = RequestMoney::latest()->where(['start_office_id' => $this->currentOffice->id])->get();

        return view('requestMoney.index', compact('requests'));
    }

    public function create()
    {
        $this->setProperties();
        $currentOffice = $this->currentOffice;
        $offices = Office::all();
        $collectors = Collector::all();
        $currencies = Currency::all();
        $cashCurrency = $this->cashCurrency;

        return view('requestMoney.create', compact( 'currentOffice','offices', 'collectors', 'currencies', 'cashCurrency'));
    }

    public function store()
    {
        $this->setProperties();

        if(in_array(request()->input('currency_id'), $this->cashCurrency)){
            $data = request()->validate([
                'currency_id' => 'required|integer',
                'request_office_id' => 'required|integer',
                'amount' => 'required|integer',
                'collector_id' => 'required|integer',
            ]);
        }else{
            $data = request()->validate([
                'currency_id' => 'required|integer',
                'request_office_id' => 'required|integer',
                'amount' => 'required|integer',
            ]);
        }

        $workDay = $this->currentWorkDay;
        $currentOffice = $this->currentOffice;

        if($workDay->id){
            $data['work_day_id'] = $workDay->id;
        }
        if($currentOffice->id){
            $data['start_office_id'] = $currentOffice->id;
        }

        RequestMoney::create($data);

        return redirect()->route('index');
    }

    public function show(RequestMoney $requestMoney)
    {
        return false;
    }

    public function edit(RequestMoney $requestMoney)
    {
        return false;
    }

    public function update(RequestMoney $requestMoney)
    {
        return false;
    }

    public function delete(RequestMoney $requestMoney)
    {

        $requestMoney->delete();

        return redirect()->route('requestMoney.index');
    }

    public function destroy($id)
    {
        $requestMoney = RequestMoney::find($id);
        $requestMoney->delete();

        return redirect()->back();
    }

    public function restore()
    {

        $requestMoney = RequestMoney::withTrashed()->find(2);
        $requestMoney->restore();

    }

}
