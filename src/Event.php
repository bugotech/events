<?php namespace Bugotech\Events;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
