<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;

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
     $this->line('<fg=yellow>Configuration');
    foreach($conf as $key => $val){
        if(is_array($val)){
            foreach($val as $v){
                $vl .= $v.", ";
            }
        } else{
                $vl = $val;
            }

         $this->line('<fg=default>'.$key.' = <fg=cyan>'.$vl);
        }
    }
    
   
}
