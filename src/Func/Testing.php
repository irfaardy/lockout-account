<?php 
namespace Irfa\Lockout\Func;

use Irfa\Lockout\Func\Core;
use Illuminate\Console\Command;
use View;
use File;

class Testing extends Core {

    public function testConfig(){
        $ret=[];
        $ret['err'] = 0;
        if(!empty(config('irfa.lockout'))){
            if(is_numeric(config('irfa.lockout.login_attemps'))){
                $ret['login_attemps'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['login_attemps'] ='<fg=yellow>Must be a number';
            }

            if(is_bool(config('irfa.lockout.logging'))){
               $ret['logging'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['logging'] = '<fg=yellow>Must be a Boolean'; 
            }

            if(is_string(config('irfa.lockout.input_name'))){
                $ret['input_name'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['input_name'] = '<fg=yellow>Must be a String'; 
            }
            if(is_writable(config('irfa.lockout.lockout_file_path'))){
                $ret['lockout_file_path'] = '<fg=green>OK';
            } else{
                $ret['lockout_file_path'] = '<fg=yellow>Write Permission Denied in '.config('irfa.lockout.lockout_file_path'); 
            }

             if(!empty(config('irfa.lockout.redirect_url'))){
                $ret['redirect_url'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['redirect_url'] = '<fg=yellow>Must be provided'; 
            }
            if(is_array(config('irfa.lockout.protected_action_path'))){
                $ret['protected_action_path'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['protected_action_path'] = '<fg=yellow>Must be array'; 
            }

            if(is_array(config('irfa.lockout.protected_middleware_group'))){
                if(!empty(config('irfa.lockout.protected_middleware_group'))){
                    $ret['protected_middleware_group'] = '<fg=green>OK';
                } else{
                     $ret['err'] +=1;
                     $ret['protected_middleware_group'] = '<fg=yellow>Must be provided'; 
                }
            } else{

                $ret['err'] +=1;
                $ret['protected_middleware_group'] = '<fg=yellow>Must be array'; 
            }
            if(is_string(config('irfa.lockout.message_name'))){
                $ret['message_name'] = '<fg=green>OK';
            } else{

                $ret['err'] +=1;
                $ret['message_name'] = '<fg=yellow>Must be a String'; 
            }
        } else{
            $ret['err'] +=1;
            $ret['file'] = "<fg=yellow> Could't find config file. Try to run <fg=cyan>php artisan vendor:publish --tag=lockout-account"; 
        }

        return $ret;
    }
	public function testWriteEventFailedLogin($username){

    	$this->eventFailedLogin($username);

		$input = $username;
		$dir = config('irfa.lockout.lockout_file_path');
		$path = $dir.md5($input);

    	if(File::exists($path))
        {
        	return true;
        } 
    		return false;
    }
    public function testWritable($username){
		$input = $username;
		$dir = config('irfa.lockout.lockout_file_path');
		$path = $dir.md5($input);

    	if(is_writable($path))
        {
        	return true;
        } 
    		return false;
    }

    public function testManualLocking($username){
        $input = $username;
        $dir = config('irfa.lockout.lockout_file_path');
        $path = $dir.md5($input);

        if($this->lock_account($username))
        {
            return true;
        } 
            return false;
    }

    public function testUnlocking($username){
        $input = $username;
        $dir = config('irfa.lockout.lockout_file_path');
        $path = $dir.md5($input);
        $unlock =  $this->test_unlock_account($username);
        if($unlock)
        {
            return true;
        } 
            return false;
    }
    public function testLockLogin($username){
        $input = $username;
        $dir = config('irfa.lockout.lockout_file_path');
        $path = $dir.md5($input);
        $unlock =  $this->lockLogin($username);
        if($unlock)
        {
            return true;
        } 
            return false;
    }
}
