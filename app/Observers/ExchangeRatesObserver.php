<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\ExchangeRates;

class ExchangeRatesObserver
{
    /**
     * Handle the ExchangeRates "created" event.
     *
     * @param  \App\Models\ExchangeRates  $exchangeRates
     * @return void
     */
    public function created(ExchangeRates $exchangeRates)
    {
        new Log(auth()->user(), 'add', 'exchangeRates', $exchangeRates->id);
    }

    /**
     * Handle the ExchangeRates "updated" event.
     *
     * @param  \App\Models\ExchangeRates  $exchangeRates
     * @return void
     */
    public function updated(ExchangeRates $exchangeRates)
    {
        new Log(auth()->user(), 'update', 'exchangeRates', $exchangeRates->id, $exchangeRates->getDirty());
    }

    /**
     * Handle the ExchangeRates "deleted" event.
     *
     * @param  \App\Models\ExchangeRates  $exchangeRates
     * @return void
     */
    public function deleted(ExchangeRates $exchangeRates)
    {
        new Log(auth()->user(), 'delete', 'exchangeRates', $exchangeRates->id);
    }

    /**
     * Handle the ExchangeRates "restored" event.
     *
     * @param  \App\Models\ExchangeRates  $exchangeRates
     * @return void
     */
    public function restored(ExchangeRates $exchangeRates)
    {
        //
    }

    /**
     * Handle the ExchangeRates "force deleted" event.
     *
     * @param  \App\Models\ExchangeRates  $exchangeRates
     * @return void
     */
    public function forceDeleted(ExchangeRates $exchangeRates)
    {
        //
    }
}
