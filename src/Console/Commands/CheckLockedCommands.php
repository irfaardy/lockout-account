<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Irfa\Lockout\Func\Core,Lockout;
use Symfony\Component\Console\Helper\Table;

class CheckLockedCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lockout:is-locked {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Account';

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
    public function handle(Core $core)
    { 
        $username = $this->argument('username');
        $lock = Lockout::isLocked($username);
            $table = new Table($this->output);
            if($lock){
                $table->setRows([
                        ['<fg=yellow>'.$username.' is locked',]]);
                 $table->render();
                $this->line('<fg=default>Run <fg=cyan>php artisan lockout:unlock '.$username.'<fg=default> to unlock account.'); 
            } else{
                 $table->setRows([
                        ['<fg=green>'.$username.' is unlocked',]]);
                  $table->render();
                         $this->line('<fg=default>Run <fg=cyan>php artisan lockout:lock '.$username.'<fg=default> to lock account.');  
            }   
                       
                // $this->line('<fg=yellow>Valid input is  lock, unlock, and attemps.');
        
    }
    
}