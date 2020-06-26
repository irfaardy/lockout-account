

# **Lockout Account  for  Laravel**
 [![Support me](https://img.shields.io/badge/Support-Buy%20me%20a%20coffee-yellow.svg?style=flat-square)](https://www.buymeacoffee.com/OBaAofN) [![Latest Stable Version](https://poser.pugx.org/irfa/lockout/v)](//packagist.org/packages/irfa/lockout) 


This package is useful for locking an account if someone tries to log into your account, this package can be implemented into the admin dashboard login, information system, cloud, etc.


<h3>🛠️ Installation with Composer </h3>

```php
composer require irfa/lockout
```

>You can get Composer [ here]( https://getcomposer.org/download/)

***
<h2>🛠️ Laravel Setup </h2>

<h3>1. Add to config/app.php</h3>

```php
'providers' => [
      	 ....
         Irfa\Lockout\LockoutAccountServiceProvider::class, 
     ];
```

<h3>2. Add to config/app.php</h3>

```php
'aliases' => [
         ....
    	'Lockout' => Irfa\Lockout\Facades\Lockout::class,
],
```

  <h2>3. Publish Vendor</h2>


    php artisan vendor:publish --tag=account-lockout

Open .env file and add this line (optional)

```php
....
LOGIN_ATTEMPS=3
LOGGING=true
    
```



<h2>Usage</h2>

<hr>

<h2>Unlock Account</h2>

Unlock account with Console artisan

```php
php artisan lockout:unlock username
```

Unlock account programmatically

```php
use Lockout;
use Request;

class UserManage {
	public function account_unlock(Request $request){
        Lockout::unlock($request->email);
        return redirect()->back();
    }
}
```



<h2> Lock Account manually</h2>

Lock account with Console artisan

```
php artisan lockout:lock username
```

Lock Account programmatically

```php
use Lockout;
use Request;

class UserManage {
	public function account_unlock(Request $request){
        Lockout::lock($request->email);
        return redirect()->back();
    }
}
```

<h2> Check Login Attemps</h2>

View login attemps with Console artisan

```
php artisan lockout:check username
```

Check Login attemps programmatically

```php
use Lockout;
use Request;

class UserManage {
	public function account_unlock(Request $request){
        $lockout = Lockout::check($request->email);
        foreach($lockout as $data){
            echo $data->username."\n";
            echo $data->attemps."\n";
            echo $data->ip."\n";
            echo $data->last_attemps."\n";
        }
    }
}
```

<h2>Clear all Login Attemps</h2>

```
php artisan lockout:clear
```

Clear all programmatically

```php
use Lockout;
use Request;

class UserManage {
	public function account_unlock(Request $request){
       Lockout::clearAll();
    }
}
```

------

**Other Commands**

**show package info**

```php
php artisan lockout:info
```
-------

**Change Messages**<br>
You can change message in ``resources/lang/{language}/lockoutMessage.php``

-------
**How to Uninstall**

1. **Run this command** 
   ( if your application runs in production it is recomended to run ``php artisan down`` before running this command)

```php
composer remove irfa/lockout
```

2. **Remove service provider for this package in config/app.php**

```php
'providers' => [
      	 ....
         Irfa\Lockout\LockoutAccountServiceProvider::class, 
     ];
```

3. **Remove aliases for this package in config/app.php**

```php
'aliases' => [
         ....
    	'Lockout' => Irfa\Lockout\Facades\Lockout::class,
],
```

4. **Remove file config/irfa/lockout.php** 
   ( if your application runs in production it is recomended to run ``php artisan up`` after running this command)

------

## How to Contributing

1. Fork it (<https://github.com/irfaardy/lockout-account/fork>)
3. Commit your changes (`git commit -m 'Add some Feature'`)
4. Push to the branch (`git push origin master`)
5. Create a new Pull Request
***

**LICENSE**<br>
<a href="https://github.com/irfaardy/lockout-account/blob/master/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/irfaardy/lockout-account?style=for-the-badge"></a>

