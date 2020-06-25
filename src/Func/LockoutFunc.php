<?php 
namespace Irfa\Lockout\Func;

use Irfa\Lockout\Func\Core;

class LockoutFunc extends Core {
	private $username;
	private $ip;

	public function username($username){
		$this->username = $username;

		return $this;
	}
	public function ip($ip){
		$this->ip = $ip;

		return $this;
	}
	public function unlock($username){

	}

	public function lock($username){

	}
	public function attemps($username) {

	}
	public function clearLocked(){

	}
}
