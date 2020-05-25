<?php

namespace App\Observers;

use App\Status;
use Illuminate\Support\Facades\Cache;

class StatusObserver
{
    /**
     * Handle the status "created" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function created(Status $status)
    {
        Cache::forget('statuses');
    }

    /**
     * Handle the status "updated" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function updated(Status $status)
    {
        Cache::forget('statuses');
    }

    /**
     * Handle the status "deleted" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function deleted(Status $status)
    {
        Cache::forget('statuses');
    }

    /**
     * Handle the status "restored" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function restored(Status $status)
    {
        Cache::forget('statuses');
    }

    /**
     * Handle the status "force deleted" event.
     *
     * @param  \App\Status  $status
     * @return void
     */
    public function forceDeleted(Status $status)
    {
        Cache::forget('statuses');
    }
}
