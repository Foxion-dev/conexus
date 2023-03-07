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
//        $test = Client::search('tele')->get();
//        dd($data);
        if($data['work_day'] === null) {
            auth()->logout();
            return redirect()->route('login');
        }

        if(!is_null($data['work_day']->finish)){
            return view('closed', compact('data'));
        }

        $this->current_day = $data['work_day'];
        $data['deals'] = $data['work_day']->deals->take(-3)->sortByDesc('created_at');
        $data['expenses'] = $data['work_day']->expenses->take(-3)->sortByDesc('created_at');
        $data['encashments'] = $data['work_day']->encashments->take(-3)->sortByDesc('created_at');

        return view('dashboard', compact('data'));
    }
}
