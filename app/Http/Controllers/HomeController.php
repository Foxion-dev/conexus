<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = [];

        $data['deals'] = Deal::latest()->take(3)->get();
        $data['clients'] = Client::all();
//        dd($data['deals']);
        return view('dashboard', compact('data'));

    }
}
