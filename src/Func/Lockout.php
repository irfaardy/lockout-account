<?php 
namespace Irfa\Lockout\Func;

use Irfa\Lockout\Func\Core;

class Lockout extends Core {
	
    public function unlock($username){
        if(is_array($username)){
            foreach($username as $key){
                $this->_unlock($key);
            }
        } else{
            $this->_unlock($username);
        }
        return true;
    }

    public function lock($username){
        if(is_array($username)){
            foreach($username as $key){
                    $this->_lock($key);
            }
        } else{
                $this->_lock($username);
        }
        return true;
    }
    public function check($username) {	 
        $ret = null;
        if(is_array($username)){
            foreach($username as $key){
                $get = $this->_check($key);
                if(!empty($get)){
                    $ret[] = $get;
                }
            }
        } else{
                $ret = $this->_check($username);
        }
        $ret = json_encode($ret);
        return json_decode($ret);
    }
    public function clearLocked(){
        return $this->clear_all();
    }

    private function _unlock($username){
        $this->unlock_account($username);
    }
    private function _lock($username){
        $this->lock_account($username);
    }
    private function _check($username){
        return json_decode($this->check_account($username),true);
    }
}
