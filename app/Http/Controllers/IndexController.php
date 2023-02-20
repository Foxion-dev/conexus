<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {
        $data = [];

        $data['deals'] = Deal::all();
        $data['clients'] = Client::all();

        return view('dashboard', compact('data'));
    }
}
