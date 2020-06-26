<?php

namespace Irfa\Lockout\Middleware;

use Closure;
use Auth;
use Session;
use Route;
use URL;
use Lang;
use Illuminate\Support\Facades\File;
use Irfa\Lockout\Func\Core;

class LockAccount extends Core
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() == "POST") {
            if (in_array($request->path(), config('irfa.lockout.protected_action_path'))) {
                if ($this->lockLogin()) {
                    $this->eventFailedLogin();
                    $this->logging();
                    Session::flash(config('irfa.lockout.message_name'), Lang::get('lockoutMessage.locked'));
                    return redirect(empty(config('irfa.lockout.redirect_url')) ? "/" : URL::to(config('irfa.lockout.redirect_url')));
                }
            }
        }
            return $next($request);
    }
}
