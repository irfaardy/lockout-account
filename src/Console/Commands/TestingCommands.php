<?php

namespace Irfa\Lockout\Console\Commands;

use Illuminate\Console\Command;
use Irfa\Lockout\Func\Testing;
use Symfony\Component\Console\Helper\Table;
use URL;
use Str;

class TestingCommands extends Command
{
    private $error=0;
    private $success=0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lockout:test';

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
    public function handle()
    {
        $domain = strtolower(config("app.name")).".com";
         $this->line('<fg=default>--------------------------------------------');
        $this->testWrite($domain);
        sleep(1);
        $this->testManualLock($domain);
        sleep(1);
        $this->testLocked($domain); 
        sleep(1);
        $this->testUnlock($domain);

    }
    private function testWrite($domain){
        $test = new Testing();
         if( $test->testWriteEventFailedLogin('lock-test@'.$domain) AND $test->testWritable('lock-test@'.$domain)){
           $this->line('<fg=default>Auto Lock : <fg=green>OK');
        } elseif(!$test->testWritable('lock-test@'.$domain)){
            $this->success += 1;
            $this->line('<fg=default>Auto Lock : <fg=yellow>Warning (Permission denied)');
        } else{
            $this->error += 1;
             $this->line('<fg=default>Auto Lock : <fg=red>Failed');
        }
    } 
    private function testManualLock($domain){
        $test = new Testing();
         if( $test->testManualLocking('lock-test@'.$domain)){
            $this->success += 1;
           $this->line('<fg=default>Manual Lock : <fg=green>OK');
        } else{
            $this->error += 1;
             $this->line('<fg=default>Manual Lock : <fg=red>Failed');
        }
    }
    private function testUnlock($domain){
        $test = new Testing();
         if( $test->testUnlocking('lock-test@'.$domain)){
           $this->success += 1;
           $this->line('<fg=default>Unlock Account : <fg=green>OK');
        } else{
             $this->error += 1;
             $this->line('<fg=default>Unlock Account : <fg=red>Failed');
        }
    }

    private function testLocked($domain){
        $test = new Testing();
         if( $test->testLockLogin('lock-test@'.$domain)){
           $this->success += 1;
           $this->line('<fg=default>Try Login with locked account : <fg=green>Account is Locked');
        } else{
             $this->error += 1;
             $this->line('<fg=default>Try Login with locked account : <fg=red>Account logged in');
        }
    }
   
}
