<?php

namespace App\Listeners;

use App\Events\ClearCacheEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClearCacheEvent  $event
     * @return void
     */
    public function handle(ClearCacheEvent $event)
    {
        Cache::clear();
    }
}
