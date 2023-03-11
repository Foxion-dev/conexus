<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Deal;

class DealObserver
{
    /**
     * Handle the Deal "created" event.
     *
     * @param  \App\Models\Deal  $deal
     * @return void
     */
    public function created(Deal $deal)
    {
        new Log(auth()->user(), 'add', 'deal', $deal->id);
    }

    /**
     * Handle the Deal "updated" event.
     *
     * @param  \App\Models\Deal  $deal
     * @return void
     */
    public function updated(Deal $deal)
    {
        new Log(auth()->user(), 'update', 'deal', $deal->id, $deal->getDirty());
    }

    /**
     * Handle the Deal "deleted" event.
     *
     * @param  \App\Models\Deal  $deal
     * @return void
     */
    public function deleted(Deal $deal)
    {
        new Log(auth()->user(), 'delete', 'deal', $deal->id);
    }

    /**
     * Handle the Deal "restored" event.
     *
     * @param  \App\Models\Deal  $deal
     * @return void
     */
    public function restored(Deal $deal)
    {
        //
    }

    /**
     * Handle the Deal "force deleted" event.
     *
     * @param  \App\Models\Deal  $deal
     * @return void
     */
    public function forceDeleted(Deal $deal)
    {
        //
    }
}
