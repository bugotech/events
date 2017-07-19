<?php

if (! function_exists('event')) {
    /**
     * Fire an event and call the listeners or return Dispatcher.
     *
     * @param  object|string  $event
     * @param  mixed   $payload
     * @param  bool    $halt
     * @return array|null|\Illuminate\Contracts\Events\Dispatcher
     */
    function event($event = null, $payload = [], $halt = false)
    {
        if (is_null($event)) {
            return app('events');
        }

        return app('events')->fire($event, $payload, $halt);
    }
}