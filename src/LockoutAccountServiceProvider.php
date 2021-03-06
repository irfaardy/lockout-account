<?php

namespace Irfa\Lockout;

use Illuminate\Support\ServiceProvider;
use Irfa\Lockout\Listeners\LockoutAccount;
use Irfa\Lockout\Listeners\LoginLock;
use Irfa\Lockout\Listeners\CleanLockoutAccount;
use Artisan;

class LockoutAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $commands = [
        'Irfa\Lockout\Console\Commands\LockCommands',
        'Irfa\Lockout\Console\Commands\UnlockCommands',
        'Irfa\Lockout\Console\Commands\AttempsCommands',
        'Irfa\Lockout\Console\Commands\LockInfoPackage',
        'Irfa\Lockout\Console\Commands\ClearLockCommands',
        'Irfa\Lockout\Console\Commands\CheckLockedCommands',
        'Irfa\Lockout\Console\Commands\TestingCommands',
    ];

    public function register()
    {

       
        $router = $this->app['router'];
        $this->commands($this->commands);
        if(!empty(config('irfa.lockout'))){
            \Illuminate\Support\Facades\Event::listen(
                \Illuminate\Auth\Events\Failed::class,
                LockoutAccount::class
            );
            \Illuminate\Support\Facades\Event::listen(
                \Illuminate\Auth\Events\Authenticated::class,
                CleanLockoutAccount::class
            );
                if(in_array('api', config('irfa.lockout.protected_middleware_group'))){
                    $router->pushMiddlewareToGroup('api', \Irfa\Lockout\Middleware\ApiLockAccount::class);
                }
                if(in_array('web', config('irfa.lockout.protected_middleware_group'))){
                        $router->pushMiddlewareToGroup('web', \Irfa\Lockout\Middleware\LockAccount::class);
                }
                if(in_array(null, config('irfa.lockout.protected_middleware_group'))){
                        $router->pushMiddlewareToGroup('web', \Irfa\Lockout\Middleware\LockAccount::class);
                }
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resource/config/irfa/lockout.php' => config_path('irfa/lockout.php'), 
            __DIR__.'/../resource/lang' => resource_path('lang'), ], 'lockout-account');

    }
}
