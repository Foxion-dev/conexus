<?php

namespace App\Observers;

use App\Components\Log;
use App\Models\OfficeDay;

class OfficeDayObserver
{
    /**
     * Handle the OfficeDay "created" event.
     *
     * @param  \App\Models\OfficeDay  $officeDay
     * @return void
     */
    public function created(OfficeDay $officeDay)
    {
        new Log(auth()->user(), 'add', 'officeDay', $officeDay->id);
    }

    /**
     * Handle the OfficeDay "updated" event.
     *
     * @param  \App\Models\OfficeDay  $officeDay
     * @return void
     */
    public function updated(OfficeDay $officeDay)
    {
        new Log(auth()->user(), 'update', 'officeDay', $officeDay->id, $officeDay->getDirty());
    }

    /**
     * Handle the OfficeDay "deleted" event.
     *
     * @param  \App\Models\OfficeDay  $officeDay
     * @return void
     */
    public function deleted(OfficeDay $officeDay)
    {
        new Log(auth()->user(), 'delete', 'officeDay', $officeDay->id);
    }

    /**
     * Handle the OfficeDay "restored" event.
     *
     * @param  \App\Models\OfficeDay  $officeDay
     * @return void
     */
    public function restored(OfficeDay $officeDay)
    {
        //
    }

    /**
     * Handle the OfficeDay "force deleted" event.
     *
     * @param  \App\Models\OfficeDay  $officeDay
     * @return void
     */
    public function forceDeleted(OfficeDay $officeDay)
    {
        //
    }
}
