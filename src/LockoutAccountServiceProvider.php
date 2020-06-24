<?php

namespace Irfa\Lockout;

use Illuminate\Support\ServiceProvider;
use Irfa\Lockout\Listeners\LockoutAccount;

class LockoutAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $commands = [
      
    ];

    public function register()
    {
        $this->commands($this->commands);
        \Illuminate\Support\Facades\Event::listen(
           \Illuminate\Auth\Events\Failed::class,
            LockoutAccount::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resource/config/irfa/lockout.php' => config_path('irfa/lockout.php'), ], 'lockout-account');

    }
}
