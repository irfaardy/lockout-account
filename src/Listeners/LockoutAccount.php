<?php

namespace  Irfa\Lockout\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Request,File;

class LockoutAccount
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
        $matchip= config('irfa.lockout.match_ip') == true ? Request::ip():null;
        $dir = storage_path('lockout/account/locked/');
        $path = $dir.md5(Request::input('email').$matchip);
        if(!File::exists($dir)){
             File::makeDirectory($dir, 0755, true);
        }

        if(!File::exists($path))
        {
            $login_fail = 0;
        } else{
            $get = json_decode(File::get($path));
            $login_fail = $get->attemps+1;
        }
            $content = ['attemps' => $login_fail,'last_ip' => Request::ip(),'last_attemps' => time()];
            File::put($path,json_encode($content));
        
    }
}
