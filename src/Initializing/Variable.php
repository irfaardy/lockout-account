<?php
namespace Irfa\Lockout\Initializing;

use Illuminate\Support\Facades\Request;

class Variable {

		protected $ip;
	    protected $input;
	    protected $dir;
	    protected $path;
	    protected $permission_code;

	    /**
		 * Initializing variable.
		 *
		 * @return void
		 */
		protected function initVar(){
	        $this->ip = Request::ip();
	        $this->input = Request::input(config('irfa.lockout.input_name'));
	        $this->dir = config('irfa.lockout.lockout_file_path');
	        $this->path = $this->dir.md5($this->input);
    	}
	
	}