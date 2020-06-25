<?php

namespace Irfa\Lockout;

use Illuminate\Support\ServiceProvider;
use Irfa\Lockout\Listeners\LockoutAccount;
use Irfa\Lockout\Listeners\LoginLock;

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
    ];

    public function register()
    {
        $router = $this->app['router'];
        $this->commands($this->commands);
        \Illuminate\Support\Facades\Event::listen(
           \Illuminate\Auth\Events\Failed::class,
            LockoutAccount::class
        );
        $router->pushMiddlewareToGroup('web',\Irfa\Lockout\Middleware\LockAccount::class);

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
            __DIR__.'/../resource/lang' => resource_path('lang'),], 'lockout-account');

    }
}
