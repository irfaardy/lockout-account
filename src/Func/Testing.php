<?php 
namespace Irfa\Lockout\Func;

use Irfa\Lockout\Func\Core;
use View;
use File;

class Testing extends Core {
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
