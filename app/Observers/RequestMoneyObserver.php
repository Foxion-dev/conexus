<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\RequestMoney;

class RequestMoneyObserver
{
    /**
     * Handle the RequestMoney "created" event.
     *
     * @param  \App\Models\RequestMoney  $requestMoney
     * @return void
     */
    public function created(RequestMoney $requestMoney)
    {
        new Log(auth()->user(), 'add', 'requestMoney', $requestMoney->id);
    }

    /**
     * Handle the RequestMoney "updated" event.
     *
     * @param  \App\Models\RequestMoney  $requestMoney
     * @return void
     */
    public function updated(RequestMoney $requestMoney)
    {
        new Log(auth()->user(), 'update', 'requestMoney', $requestMoney->id, $requestMoney->getDirty());
    }

    /**
     * Handle the RequestMoney "deleted" event.
     *
     * @param  \App\Models\RequestMoney  $requestMoney
     * @return void
     */
    public function deleted(RequestMoney $requestMoney)
    {
        new Log(auth()->user(), 'delete', 'requestMoney', $requestMoney->id);
    }

    /**
     * Handle the RequestMoney "restored" event.
     *
     * @param  \App\Models\RequestMoney  $requestMoney
     * @return void
     */
    public function restored(RequestMoney $requestMoney)
    {
        //
    }

    /**
     * Handle the RequestMoney "force deleted" event.
     *
     * @param  \App\Models\RequestMoney  $requestMoney
     * @return void
     */
    public function forceDeleted(RequestMoney $requestMoney)
    {
        //
    }
}
