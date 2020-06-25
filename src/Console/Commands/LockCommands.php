<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Irfa\Lockout\Func\Core;
use Symfony\Component\Console\Helper\Table;

class LockCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:lock {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lock Account';

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
        $this->line('Locking '.$this->argument('username').'...');
        if($core->lock_account($this->argument('username'))!="error"){
            $table = new Table($this->output);
            $table->setRows([
                        ['<fg=green>'.$this->argument('username').' successfully locked.'],
                       
                    ]);
                     $table->render();
        } else{
             $this->line('<fg=red> Locking failed.');
        }
    }
    
}
