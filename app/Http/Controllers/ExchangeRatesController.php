<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

class ExchangeRatesController extends BaseController
{
    public function index()
    {
        $exchangeRates = new ExchangeRate();

        dd($exchangeRates->exchangeRate('USD', ['GEL', 'KZT', 'RUB']));
    }
}
