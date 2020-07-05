<?php
namespace Irfa\Lockout\Initializing;

use Illuminate\Support\Facades\Request;

class Variable {

		protected $ip;
	    protected $input=null;
	    protected $dir;
	    protected $path;
	    protected $attemps;
	    protected $permission_code;

	    /**
		 * Initializing variable.
		 *
		 * @return void
		 */
		protected function initVar(){
			if(!empty(config('irfa.lockout'))){
		        $this->ip = Request::ip();
		        $this->input = Request::input(config('irfa.lockout.input_name'));
		        $this->dir = config('irfa.lockout.lockout_file_path');
		        $this->attemps = config('irfa.lockout.login_attemps');
		        $this->path = $this->dir.md5($this->input);
		    }
    	}

    	protected function setPath($username){
    		$this->path = $this->dir.md5($username);
    		$this->input = $username;
    	}
	
	}