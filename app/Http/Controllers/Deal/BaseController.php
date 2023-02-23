<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Services\Post\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

//    public function __construct(Service $service)
//    {
//        $this->service = $service;
//    }
}
