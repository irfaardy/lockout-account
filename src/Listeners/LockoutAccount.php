<?php

namespace  Irfa\Lockout\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Request, File;
use Irfa\Lockout\Func\Core;

class LockoutAccount extends Core
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
     * @param  object  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $this->logging();
        $this->eventFailedLogin();
        
    }
}
