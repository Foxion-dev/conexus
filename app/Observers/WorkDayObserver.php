<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\WorkDay;

class WorkDayObserver
{
    /**
     * Handle the WorkDay "created" event.
     *
     * @param  \App\Models\WorkDay  $workDay
     * @return void
     */
    public function created(WorkDay $workDay)
    {
        new Log(auth()->user(), 'add', 'workDay', $workDay->id);
    }

    /**
     * Handle the WorkDay "updated" event.
     *
     * @param  \App\Models\WorkDay  $workDay
     * @return void
     */
    public function updated(WorkDay $workDay)
    {
        new Log(auth()->user(), 'update', 'workDay', $workDay->id, $workDay->getDirty());
    }

    /**
     * Handle the WorkDay "deleted" event.
     *
     * @param  \App\Models\WorkDay  $workDay
     * @return void
     */
    public function deleted(WorkDay $workDay)
    {
        new Log(auth()->user(), 'delete', 'workDay', $workDay->id);
    }

    /**
     * Handle the WorkDay "restored" event.
     *
     * @param  \App\Models\WorkDay  $workDay
     * @return void
     */
    public function restored(WorkDay $workDay)
    {
        //
    }

    /**
     * Handle the WorkDay "force deleted" event.
     *
     * @param  \App\Models\WorkDay  $workDay
     * @return void
     */
    public function forceDeleted(WorkDay $workDay)
    {
        //
    }
}
