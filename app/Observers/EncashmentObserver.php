<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Encashment;

class EncashmentObserver
{
    /**
     * Handle the Encashment "created" event.
     *
     * @param  \App\Models\Encashment  $encashment
     * @return void
     */
    public function created(Encashment $encashment)
    {
        new Log(auth()->user(), 'add', 'encashment', $encashment->id);
    }

    /**
     * Handle the Encashment "updated" event.
     *
     * @param  \App\Models\Encashment  $encashment
     * @return void
     */
    public function updated(Encashment $encashment)
    {
        new Log(auth()->user(), 'update', 'encashment', $encashment->id, $encashment->getDirty());
    }

    /**
     * Handle the Encashment "deleted" event.
     *
     * @param  \App\Models\Encashment  $encashment
     * @return void
     */
    public function deleted(Encashment $encashment)
    {
        new Log(auth()->user(), 'delete', 'encashment', $encashment->id);
    }

    /**
     * Handle the Encashment "restored" event.
     *
     * @param  \App\Models\Encashment  $encashment
     * @return void
     */
    public function restored(Encashment $encashment)
    {
        //
    }

    /**
     * Handle the Encashment "force deleted" event.
     *
     * @param  \App\Models\Encashment  $encashment
     * @return void
     */
    public function forceDeleted(Encashment $encashment)
    {
        //
    }
}
