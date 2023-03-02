<?php

namespace App\Http\Controllers;

use App\Models\WorkDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected $current_day;

    public function __construct()
    {
        $this->middleware('auth');

//        $this->current_day = WorkDay::find(Cookie::get('current_day'));
//        View::share('current_day', $this->current_day);
    }
}
