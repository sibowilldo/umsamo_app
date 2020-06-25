<?php

namespace App\Observers;

use App\EventDate;
use App\Repositories\EventDateRepository;

class EventDateObserver
{
    /**
     * Handle the event date "created" event.
     *
     * @param  \App\EventDate  $eventDate
     * @return void
     */
    public function created(EventDate $eventDate)
    {

    }

    /**
     * Handle the event date "updated" event.
     *
     * @param  \App\EventDate  $eventDate
     * @return void
     */
    public function updated(EventDate $eventDate)
    {

    }

    /**
     * Handle the event date "deleted" event.
     *
     * @param  \App\EventDate  $eventDate
     * @return void
     */
    public function deleted(EventDate $eventDate)
    {
        //
    }

    /**
     * Handle the event date "restored" event.
     *
     * @param  \App\EventDate  $eventDate
     * @return void
     */
    public function restored(EventDate $eventDate)
    {
        //
    }

    /**
     * Handle the event date "force deleted" event.
     *
     * @param  \App\EventDate  $eventDate
     * @return void
     */
    public function forceDeleted(EventDate $eventDate)
    {
        //
    }
}
