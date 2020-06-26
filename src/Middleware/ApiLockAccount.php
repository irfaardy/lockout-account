<?php

namespace Irfa\Lockout\Middleware;

use Closure;
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
                    $this->logging("API");
                    $message['code'] = 403;
                    $message[config('irfa.lockout.message_name')] = Lang::get('lockoutMessage.locked');
                    return response()->json($message);
                }
            }
        }
            return $next($request);
    }
}
