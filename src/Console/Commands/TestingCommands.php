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
    protected $signature = 'lockout:diagnose';

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
    	$curTime = microtime(true);
        $domain = 'locktest-'.md5(strtolower(config("app.name"))).'@'.strtolower(config("app.name")).".com";
         $this->line('<fg=default>--------------------------------------------');
        $this->testConfigurations();
        $this->line('<fg=default>Testing Mail : <fg=cyan>'.$domain);        
        $this->testWrite($domain);        
        $this->testManualLock($domain);        
        $this->testLocked($domain);         
        $this->testUnlock($domain);        
        $end=time();
        $this->line('<fg=default>--------------------------------------------');
        $this->line('<fg=default>Tested at: '.date('Y-m-d H:m:s',time()));
        $this->line('<fg=default>Test time : '.(round(microtime(true) - $curTime,3)*1000)." ms");

    }
    private function testWrite($domain){
        $test = new Testing();
         if( $test->testWriteEventFailedLogin($domain) AND $test->testWritable($domain)){
           $this->line('<fg=default>Auto Lock : <fg=green>OK');
        } elseif(!$test->testWritable($domain)){
            $this->success += 1;
            $this->line('<fg=default>Auto Lock : <fg=yellow>Warning (Permission denied)');
        } else{
            $this->error += 1;
             $this->line('<fg=default>Auto Lock : <fg=red>Failed');
        }
    } 
    private function testManualLock($domain){
        $test = new Testing();
         if( $test->testManualLocking($domain)){
            $this->success += 1;
           $this->line('<fg=default>Manual Lock : <fg=green>OK');
        } else{
            $this->error += 1;
             $this->line('<fg=default>Manual Lock : <fg=red>Failed');
        }
    }
    private function testUnlock($domain){
        $test = new Testing();
         if( $test->testUnlocking($domain)){
           $this->success += 1;
           $this->line('<fg=default>Unlock Account : <fg=green>OK');
        } else{
             $this->error += 1;
             $this->line('<fg=default>Unlock Account : <fg=red>Failed');
        }
    }

    private function testLocked($domain){
        $test = new Testing();
         if( $test->testLockLogin($domain)){
           $this->success += 1;
           $this->line('<fg=default>Try Login with locked account : <fg=green>Account is Locked');
        } else{
             $this->error += 1;
             $this->line('<fg=default>Try Login with locked account : <fg=red>Account logged in');
        }
    }

    private function testConfigurations(){
    	 $test = new Testing();
    	 $res  = $test->testConfig();
    	 
    	 	$table = new Table($this->output);
    	 	$this->line('<fg=cyan>Testing Config:');
            $table->setRows([
                        ['<fg=default>login_attemps',isset($res['login_attemps']) ? $res['login_attemps']:"<fg=red>Not Found"],
                        ['<fg=default>logging',isset($res['logging']) ? $res['logging']:"<fg=red>Not Found"],
                        ['<fg=default>input_name',isset($res['input_name']) ? $res['input_name']:"<fg=red>Not Found"],
                        ['<fg=default>redirect_url',isset($res['redirect_url']) ? $res['redirect_url']:"<fg=red>Not Found"],
                        ['<fg=default>protected_action_path',isset($res['protected_action_path']) ? $res['protected_action_path']:"<fg=red>Not Found"],
                        ['<fg=default>protected_middleware_group',isset($res['protected_middleware_group']) ? $res['protected_middleware_group']:"<fg=red>Not Found"],
                        ['<fg=default>message_name',isset($res['message_name']) ? $res['message_name']:"<fg=red>Not Found"],
                       
                    ]);
                        $table->render();
    	 	
    	 if($res['err'] > 0 AND !empty($res['file'])){
    	 	$this->line('<fg=red>Testing config failed, testing is canceled.');
    	 	$this->line($res['file']);
    	 	exit();
    	 }

    }
  
   
}
