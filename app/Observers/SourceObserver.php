<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\Logger;
use App\Models\Source;

class SourceObserver
{
    /**
     * Handle the Source "created" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function created(Source $source)
    {
        new Log(auth()->user(), 'add', 'source', $source->id);
    }

    /**
     * Handle the Source "updated" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function updated(Source $source)
    {
        new Log(auth()->user(), 'update', 'source', $source->id, $source->getDirty());
    }

    /**
     * Handle the Source "deleted" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function deleted(Source $source)
    {
        new Log(auth()->user(), 'delete', 'source', $source->id);
    }

    /**
     * Handle the Source "restored" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function restored(Source $source)
    {
        //
    }

    /**
     * Handle the Source "force deleted" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function forceDeleted(Source $source)
    {
        //
    }
}
