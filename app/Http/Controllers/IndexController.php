<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use App\Models\WorkDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{

    public function index()
    {
        $data = [];

        $data['clients'] = Client::all();
        $data['work_day'] = WorkDay::find(auth()->user()->work_day_id);

        if($data['work_day'] === null) {
            auth()->logout();
        }
        $this->current_day = $data['work_day'];
        $data['deals'] = $data['work_day']->deals;

//        dump($data);

        return view('dashboard', compact('data'));
    }
}
