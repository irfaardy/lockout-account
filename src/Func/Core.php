<?php
namespace  Irfa\Lockout\Func;

use Log;
use Illuminate\Support\Facades\Request,File,Lang,Session;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\Table;
use Irfa\Lockout\Initializing\Variable;

class Core extends Variable
{
    
    /**
     * Initializing Variable.
     * Irfa\Lockout\Initializing\Variable
     *
     * @return void
     */
    public function __construct(){
        $this->initVar();
    }

    /**
     * write login attemps if login attemp is triggered.
     *
     * @param string $username
     * @return void
     */
    protected function eventFailedLogin($username=null){
        
        if($username != null){
          $this->setPath($username);
        }
        if(!File::exists($this->dir)){
                File::makeDirectory($this->dir, 0755, true);
        }

        if(!File::exists($this->path))
        {
            $login_fail = 1;
        } else{

            $get = json_decode(File::get($this->path));
            $ip_list = $get->ip;
            if(!$this->checkIp($ip_list,$this->ip)){
                array_push($ip_list,$this->ip);
            }
            if($get->attemps == "lock"){
                $login_fail = "lock";
            } else{
                $login_fail = $get->attemps+1;
            }
        }
        
            $content = ['username' => $this->input,'attemps' => $login_fail,'ip' => isset($ip_list)?$ip_list:[$this->ip],'last_attemps' => date("Y-m-d H:i:s",time())];
            File::put($this->path,json_encode($content));
            if(File::exists($this->path)){
              chmod($this->path,0755);
            }
          
    }

    /**
     * Clean Lockout file if success login
     *
     * @param  string  $rootNamespace
     * @return void
     */
    protected function eventCleanLockoutAccount(){
        $this->unlock_account($this->input);
          
    }

    /**
     * Logging Failed Login attemps
     * stored file in storage/logs/laravel.log
     *
     * @param  string  $middleware
     * @return void
     */
    protected function logging($middleware="WEB"){
        if(config('irfa.lockout.logging')){
                    Log::notice($middleware." | Login attemps fail | "."username : ".Request::input(config('irfa.lockout.input_name'))." | ipAddress : ".Request::ip()." | userAgent : ".$_SERVER['HTTP_USER_AGENT'].PHP_EOL);
            }
    }

     /**
       * Check if user is locked
       *
       * @param  string  $username
       * @return boolean
     */
    protected function is_locked($username){
        $this->setPath($username);
        if(File::exists($this->path))
        {
           $get = json_decode(File::get($this->path));
           if($get->attemps > $this->attemps || $get->attemps == "lock"){
              return true;
           } else{
              return false;
           }
        } else{
            return false;
        }
    }

    /**
       * Show message if failed x attemps
       *
       * @return string
     */
    protected function showMessage(){
        if(Session::has(config('irfa.lockout.message_name'))){
            return Session::get(config('irfa.lockout.message_name'));
        }

        return null;
    }

    /**
     * Locked account  if max attemps reached
     *
     * @return boolean
     */
    protected function lockLogin($username = null){
        
        if(php_sapi_name() == "cli" AND $username != null){
          $this->setPath($username);
        }

        if(File::exists($this->path))
        {
                $get = json_decode(File::get($this->path));
                if($get->attemps == "lock"){
                return true;
                }
                if($get->attemps > $this->attemps){
                    if($matchip){
                    if($this->checkIp($ip_list,$this->ip)){
                        return true;
                    } else{
                        return false;
                    }
                    } else{
                    return true;
                    }
                } else{
                return false;
                }
        } else{
            return false;
            }
    }

     /**
     * Check ip locked
     *
     * @return boolean
     */
    private function checkIp($ip_list,$ip){
        if(collect($ip_list)->contains($ip)){
            return true;
        } else{
            return false;
        }

    }

     /**
     * Clear all locked account
     *
     * @return boolean
     */
    public function clear_all(){
        $file = new Filesystem();
        if($file->cleanDirectory($this->path)){
        return true;
        } else{
        return false;
        }
    }

     /**
     * Unlocking account manually.
     *
     * @param string $username
     * @return mixed
     */
    public function unlock_account($username){
        $this->setPath($username);
         if(File::exists($this->path)){
            $readf = File::get($this->path);
                File::delete($this->path);
            if(php_sapi_name() == "cli"){
                echo Lang::get('lockoutMessage.user_unlock_success')."\n";
                return $readf;
              
            } else{
                return true;
            }
        } else{
            if(php_sapi_name() == "cli"){
                echo Lang::get('lockoutMessage.user_lock_404')."\n";
                return false;
            } else{
                return false;
            }
        }
      }

    /**
     * For Testing
     *
     * @return boolean or json(if cli)
     */
    public function test_unlock_account($username){
        $this->setPath($username);
         if(File::exists($this->path)){
            $readf = File::get($this->path);
                File::delete($this->path);
            if(php_sapi_name() == "cli"){
                return true;
              
            } else{
                return true;
            }
        } else{
            if(php_sapi_name() == "cli"){
               return false;
            } else{
                return false;
            }
        }
      }

    /**
     * Check account with details
     *
     * @param string $username
     * @return boolean
     */
    public function check_account($username){
      $this->setPath($username);
       if(File::exists($this->path)){
              $readf = File::get($this->path);
              if(php_sapi_name() == "cli"){
                
                  return $readf;
                
              } else{
                  return $readf;
              }
          } else{
              if(php_sapi_name() == "cli"){
                  echo Lang::get('lockoutMessage.user_lock_404')."\n";
                  exit();
              } else{
                  return false;
              }
          }
        }

     /**
     * Locking account manually
     *
     * @param string $username
     * @return boolean
     */
    public function lock_account($username){
        $sapi = php_sapi_name() == "cli"?"lock-via-cli":"lock-via-web";
        $this->setPath($username);
        try{
          if(!File::exists($this->dir)){
              File::makeDirectory($this->dir, 0755, true);
          }
              $login_fail = "lock";
        
              $content = ['username' => $this->input,'attemps' => $login_fail,'ip' => isset($ip_list)?$ip_list:[$sapi],'last_attemps' => date("Y-m-d H:i:s",time())];
              File::put($this->path,json_encode($content));
              if(File::exists($this->path)){
                chmod($this->path,0755);
              }
              if(php_sapi_name() == "cli"){
                return Lang::get('lockoutMessage.user_lock_success')."\n";
                
              } else{
              return true;
              }
          } catch(Exception $e){
              if(php_sapi_name() == "cli"){
                return "error";
                
              } else{
                return false;
              }
          }
    }
}