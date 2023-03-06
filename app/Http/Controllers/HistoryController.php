<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Encashment;
use App\Models\Expense;
use App\Models\WorkDay;
use Illuminate\Http\Request;

class HistoryController extends BaseController
{
    public function index()
    {
        $data = [];

        $data['clients'] = Client::all();
        $data['deals'] = Deal::all();
        $data['expenses'] = Expense::all();
        $data['encashments'] = Encashment::all();

        return view('history', compact('data'));
    }
}
