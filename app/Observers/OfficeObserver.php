<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Office;

class OfficeObserver
{
    /**
     * Handle the Office "created" event.
     *
     * @param  \App\Models\Office  $office
     * @return void
     */
    public function created(Office $office)
    {
        new Log(auth()->user(), 'add', 'office', $office->id);
    }

    /**
     * Handle the Office "updated" event.
     *
     * @param  \App\Models\Office  $office
     * @return void
     */
    public function updated(Office $office)
    {
        new Log(auth()->user(), 'update', 'office', $office->id, $office->getDirty());
    }

    /**
     * Handle the Office "deleted" event.
     *
     * @param  \App\Models\Office  $office
     * @return void
     */
    public function deleted(Office $office)
    {
        new Log(auth()->user(), 'delete', 'office', $office->id);
    }

    /**
     * Handle the Office "restored" event.
     *
     * @param  \App\Models\Office  $office
     * @return void
     */
    public function restored(Office $office)
    {
        //
    }

    /**
     * Handle the Office "force deleted" event.
     *
     * @param  \App\Models\Office  $office
     * @return void
     */
    public function forceDeleted(Office $office)
    {
        //
    }
}
