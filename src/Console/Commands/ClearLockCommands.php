<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Irfa\Lockout\Func\Core;
use Symfony\Component\Console\Helper\Table;

class ClearLockCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lockout:clear';

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
        $this->line('Cleaning locked user...');
        if($core->clear_all()){
            $table = new Table($this->output);
            $table->setRows([
                        ['<fg=green>Locked Account(s) Cleared.'],
                       
                    ]);
                     $table->render();
        } else{
             $this->line('<fg=red> Clearing failed.');
        }
    }
    
}
