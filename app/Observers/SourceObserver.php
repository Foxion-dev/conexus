<?php

namespace App\Observers;

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
        $message = 'Пользователь ';
        Logger::create([
            'user_id' => auth()->user()->id,
            'action' => 'add',
            'model_name' => 'Source',
            'element_id' => $source->id,
            'message' => $message
        ]);

    }
    /**
     * Handle the Source "saving" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function saving(Source $source)
    {
        //
//        $message = '';
//        dd($source);
//        Logger::create([
//            'user_id' => auth()->user()->id,
//            'action' => 'add',
//            'model_name' => 'Source',
//            'element_id' => $source->id,
//            'message' => $message
//        ]);

    }

    /**
     * Handle the Source "updated" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function updated(Source $source)
    {
        //
    }

    /**
     * Handle the Source "deleted" event.
     *
     * @param  \App\Models\Source  $source
     * @return void
     */
    public function deleted(Source $source)
    {
        //
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
