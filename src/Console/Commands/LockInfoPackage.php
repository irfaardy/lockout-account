<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class LockInfoPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lockout:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Package Information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->informasi();
    }

    private function informasi(){
            $this->line(" _____      __             _                _               _   
|_   _|    / _|           | |              | |             | |  
  | | _ __| |_ __ _ ______| |     ___   ___| | _____  _   _| |_ 
  | || '__|  _/ _` |______| |    / _ \ / __| |/ / _ \| | | | __|
 _| || |  | || (_| |      | |___| (_) | (__|   < (_) | |_| | |_ 
 \___/_|  |_| \__,_|      \_____/\___/ \___|_|\_\___/ \__,_|\__|".PHP_EOL);

    $this->line('-------------------------------------------------------------------------------');
    $this->line('Laravel Account Lockout');
    $this->line('Version 1.0.0 (2020)');
    $this->line('<fg=cyan>https://github.com/irfaardy/lockout-account');
    $conf = config('irfa.lockout');

        $this->line('<fg=default>-------------------------------------------------------------------------------');
         $this->line('<fg=yellow>Commands');
          $table = new Table($this->output);
            $table->setRows([
                ['<fg=cyan>php artisan lockout:lock {username}','<fg=default>locking account'],
                ['<fg=cyan>php artisan lockout:unlock {username}','<fg=default>unlocking account'],
                ['<fg=cyan>php artisan lockout:check {username}','<fg=default>checking account with details'],
                ['<fg=cyan>php artisan lockout:is-locked {username}','<fg=default>checking account (return boolean)'],
                ['<fg=cyan>php artisan lockout:clear','<fg=default>unlocking all account']]
            );
          $table->render();
         $this->line('<fg=default>-------------------------------------------------------------------------------');
        $this->line('<fg=yellow>Configuration');
    foreach($conf as $key => $val){
        if(is_array($val)){
            foreach($val as $v){
                $vl .= $v.", ";
            }
        } else{
                $vl = $val;
            }
            $row[] = ['<fg=default>'.$key,' <fg=cyan>'.$vl];
        }
        // dd($row);
          $table = new Table($this->output);
            $table->setRows($row);
                        $table->render();
    }
    
   
}
