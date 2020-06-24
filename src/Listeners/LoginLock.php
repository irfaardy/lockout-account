<?php

namespace  Irfa\Lockout\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Support\Facades\Request,File;
use Irfa\Lockout\Func\Core;
use Auth;
use Session;

class LoginLock extends Core
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
    public function handle(Attempting $event)
    {
        if($this->lockLogin()){
            Auth::logout();
            header("location:".config('irfa.lockout.redirect_url'));
            exit();
        }
        
    }
}
