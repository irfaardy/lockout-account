<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Irfa\Lockout\Func\Core;
use Symfony\Component\Console\Helper\Table;

class AttempsCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:check {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unlock Account';

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
     $ret = $core->check_account($this->argument('username'));
            $table = new Table($this->output);
              $read_enc = json_decode( $ret);
              $time = $read_enc->last_attemps;
              $attemps = $read_enc->attemps;
              $ip = $read_enc->ip;
              $table->setRows([
                        ['<fg=yellow>Login attemps',  $attemps],
                        ['<fg=yellow>Last login attemps',date("Y-m-d H:i:s", $time)],
                        ['<fg=yellow>Last IP Address',empty(end($ip))? "unknown":end($ip)],]);
                     $table->render();
             // $this->line('<fg=yellow>Valid input is  lock, unlock, and attemps.');
        
    }
    
}