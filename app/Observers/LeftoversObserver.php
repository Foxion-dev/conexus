<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Leftovers;

class LeftoversObserver
{
    /**
     * Handle the Leftovers "created" event.
     *
     * @param  \App\Models\Leftovers  $leftovers
     * @return void
     */
    public function created(Leftovers $leftovers)
    {
        new Log(auth()->user(), 'add', 'deal', $leftovers->id);
    }

    /**
     * Handle the Leftovers "updated" event.
     *
     * @param  \App\Models\Leftovers  $leftovers
     * @return void
     */
    public function updated(Leftovers $leftovers)
    {
        new Log(auth()->user(), 'update', 'deal', $leftovers->id, $leftovers->getDirty());
    }

    /**
     * Handle the Leftovers "deleted" event.
     *
     * @param  \App\Models\Leftovers  $leftovers
     * @return void
     */
    public function deleted(Leftovers $leftovers)
    {
        new Log(auth()->user(), 'delete', 'deal', $leftovers->id);
    }

    /**
     * Handle the Leftovers "restored" event.
     *
     * @param  \App\Models\Leftovers  $leftovers
     * @return void
     */
    public function restored(Leftovers $leftovers)
    {
        //
    }

    /**
     * Handle the Leftovers "force deleted" event.
     *
     * @param  \App\Models\Leftovers  $leftovers
     * @return void
     */
    public function forceDeleted(Leftovers $leftovers)
    {
        //
    }
}
