<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Commission;

class CommissionObserver
{
    /**
     * Handle the Commission "created" event.
     *
     * @param  \App\Models\Commission  $commission
     * @return void
     */
    public function created(Commission $commission)
    {
        new Log(auth()->user(), 'add', 'commission', $commission->id);
    }

    /**
     * Handle the Commission "updated" event.
     *
     * @param  \App\Models\Commission  $commission
     * @return void
     */
    public function updated(Commission $commission)
    {
        new Log(auth()->user(), 'update', 'commission', $commission->id, $commission->getDirty());
    }

    /**
     * Handle the Commission "deleted" event.
     *
     * @param  \App\Models\Commission  $commission
     * @return void
     */
    public function deleted(Commission $commission)
    {
        new Log(auth()->user(), 'delete', 'commission', $commission->id);
    }

    /**
     * Handle the Commission "restored" event.
     *
     * @param  \App\Models\Commission  $commission
     * @return void
     */
    public function restored(Commission $commission)
    {
        //
    }

    /**
     * Handle the Commission "force deleted" event.
     *
     * @param  \App\Models\Commission  $commission
     * @return void
     */
    public function forceDeleted(Commission $commission)
    {
        //
    }
}
