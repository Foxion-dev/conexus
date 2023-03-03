<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\DealType;
use App\Models\Source;
use App\Models\WorkDay;
use Illuminate\Http\Request;

class DealController extends BaseController
{
    public function index()
    {
        $deals = Deal::all();
        return view('deal.index', compact('deals'));
    }

    public function create()
    {
        $clients = Client::all();
        $clientSources = Source::all();
        $currencies = Currency::all();
        $dealTypes = DealType::all();
        $workDay = WorkDay::find(auth()->user()->work_day_id);

        return view('deal.create', compact('clients', 'clientSources', 'dealTypes', 'currencies', 'workDay'));
    }

    public function store()
    {

        $customCommission = false;
        $commissionOn = false;

        $data = request()->validate([
            'type_id' => 'required|integer',
            'amount' => 'required|integer',
            'commission_on' => '',
            'percent_commission' => 'string',
            'amount_commission' => 'string',
            'issuance_amount' => 'string',
            'edit_commission' => '',
            'client_contact' => 'required|string',
            'client_name' => '',
            'client_comment' => '',
            'client_source' => 'integer',
        ]);

        if(isset($data["edit_commission"])){
            $customCommission = true;
        }

        if(isset($data["commission_on"])){
            $commissionOn = true;
        }

        $clientData = [
            'name' => $data['client_name'],
            'contact' => $data['client_contact'],
            'comment' => $data['client_comment'],
            'source_id' => $data['client_source'],
        ];

        $client = Client::firstOrCreate(
            ['name' => $data['client_name']],
            $clientData
        );

        if($data["type_id"] == 1){
            $receivingCurrency = Currency::find(1);
            $returnCurrency = Currency::find(3);
        }elseif ($data["type_id"] == 2){
            $receivingCurrency = Currency::find(3);
            $returnCurrency = Currency::find(1);
        }

        $dealData = [
            'deal_type_id' => $data["type_id"] ?? null,
            'client_id' => $client->id ?? null,
            'receiving_sum' => $data["amount"] ?? null,
            'return_sum' => $data["issuance_amount"] ?? null,
            'commission' => $data["percent_commission"] ?? null,
            'commission_sum' => $data["amount_commission"] ?? null,
            'receiving_currency_id' => $receivingCurrency->id ?? null,
            'return_currency_id' => $returnCurrency->id ?? null,
            'custom_commission' => $customCommission ? 1 : 0,
            'commission_on' => $commissionOn ? 1 : 0,
            'work_day_id' => auth()->user()->work_day_id,
        ];

        $deal = Deal::create($dealData);

        return redirect()->route('index');
    }

    public function show(Deal $deal)
    {
        return view('deal.show', compact('deal'));
    }

    public function edit(Deal $deal)
    {

        $client = Client::find($deal->client_id);
        $clients = Client::all();
        $clientSources = Source::all();
        $currencies = Currency::all();
        $dealTypes = DealType::all();
        $workDay = WorkDay::find(auth()->user()->work_day_id);

        return view('deal.edit', compact('deal','client', 'clients', 'clientSources', 'dealTypes', 'currencies', 'workDay'));
    }

    public function update(Deal $deal)
    {

        $customCommission = false;
        $commissionOn = false;

        $data = request()->validate([
            'type_id' => 'required|integer',
            'amount' => 'required|integer',
            'commission_on' => '',
            'percent_commission' => 'string',
            'amount_commission' => 'string',
            'issuance_amount' => 'string',
            'edit_commission' => '',
            'client_contact' => 'required|string',
            'client_name' => '',
            'client_comment' => '',
            'client_source' => 'integer',
        ]);

        if(isset($data["edit_commission"])){
            $customCommission = true;
        }

        if(isset($data["commission_on"])){
            $commissionOn = true;
        }

        $clientData = [
            'name' => $data['client_name'],
            'contact' => $data['client_contact'],
            'comment' => $data['client_comment'],
            'source_id' => $data['client_source'],
        ];

        $client = Client::firstOrCreate(
            ['name' => $data['client_name']],
            $clientData
        );

        if($data["type_id"] == 1){
            $receivingCurrency = Currency::find(1);
            $returnCurrency = Currency::find(3);
        }elseif ($data["type_id"] == 2){
            $receivingCurrency = Currency::find(3);
            $returnCurrency = Currency::find(1);
        }

        $dealData = [
            'deal_type_id' => $data["type_id"] ?? null,
            'client_id' => $client->id ?? null,
            'receiving_sum' => $data["amount"] ?? null,
            'return_sum' => $data["issuance_amount"] ?? null,
            'commission' => $data["percent_commission"] ?? null,
            'commission_sum' => $data["amount_commission"] ?? null,
            'receiving_currency_id' => $receivingCurrency->id ?? null,
            'return_currency_id' => $returnCurrency->id ?? null,
            'custom_commission' => $customCommission ? 1 : 0,
            'commission_on' => $commissionOn ? 1 : 0,
            'work_day_id' => auth()->user()->work_day_id,
        ];

        $deal->update($dealData);

        return redirect()->route('index');

    }

    public function delete(Deal $deal)
    {

        $deal->delete();

        return redirect()->route('index');
    }

    public function destroy(Deal $deal)
    {

        $deal->delete();

        return redirect()->route('index');
    }

    public function restore()
    {

        $deal = Deal::withTrashed()->find(2);
        $deal->restore();

//        dd('restored');
    }

}
