<?php
namespace  Irfa\Lockout\Func;

use Illuminate\Support\Facades\Request,File;

class Core
{
    protected function eventFailedLogin(){
        $ip = Request::ip();
        $matchip= config('irfa.lockout.match_ip') == true ? $ip :null;
        $dir = config('irfa.lockout.lockout_file_path');
        $path = $dir.md5(Request::input('email'));
        if(!File::exists($dir)){
             File::makeDirectory($dir, 0750, true);
        }

        if(!File::exists($path))
        {
            $login_fail = 0;
        } else{
            $get = json_decode(File::get($path));
            $ip_list = $get->ip;
            if(!$this->checkIp($ip_list,$ip)){
                array_push($ip_list,$ip);
            }
            $login_fail = $get->attemps+1;
        }
            $content = ['attemps' => $login_fail,'ip' => isset($ip_list)?$ip_list:[$ip],'last_attemps' => time()];
            File::put($path,json_encode($content));
    }
    protected function lockLogin(){
        $ip = Request::ip();
        $matchip= config('irfa.lockout.match_ip');
        $dir = config('irfa.lockout.lockout_file_path');
        $attemps = config('irfa.lockout.attemps');
        $path = $dir.md5(Request::input('email'));
        if(File::exists($path))
        {
              $get = json_decode(File::get($path));
              if($get->attemps > $attemps){
                  if($matchip){
                    if($this->checkIp($ip_list,$ip)){
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
    private function checkIp($ip_list,$ip){
        if(collect($ip_list)->contains($ip)){
            return true;
        } else{
            return false;
        }

    }     
}