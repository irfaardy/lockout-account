# Lockout Account  for  Laravel
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/badges/quality-score.png?b=master) ](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/?branch=master)[![Build Status](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/badges/build.png?b=master)](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/build-status/master)  [![StyleCI](https://github.styleci.io/repos/242054297/shield?branch=master)](https://github.styleci.io/repos/242054297) [![Support me](https://img.shields.io/badge/Support-Buy%20me%20a%20coffee-yellow.svg?style=flat-square)](https://www.buymeacoffee.com/OBaAofN) [![Latest Stable Version](https://poser.pugx.org/irfa/raja-ongkir/v/stable)](https://packagist.org/packages/irfa/raja-ongkir)



This package is useful for locking an account if someone tries to log into your account, this package can be implemented into the admin dashboard login, information system, cloud, etc.


<h3>🛠️ Installation with Composer </h3>

    composer require irfa/lockout

>You can get Composer [ here]( https://getcomposer.org/download/)

***
<h2>🛠️ Laravel Setup </h2>

<h3>Add to config/app.php</h3>

    'providers' => [
          ....
             Irfa\Lockout\LockoutAccountServiceProvider::class, 
         ];



<h3>Add to config/app.php</h3>

    'aliases' => [
             ....
        'Lockout' => Irfa\Lockout\Facades\Lockout::class,
    
        ],

  <h2>Publish Vendor</h2>


    php artisan vendor:publish --tag=account-lockout

Open .env file and add this line 

    ....
    LOGIN_ATTEMPS=3

<h2>Unlock Account</h2>

Unlock account with Console artisan

```
php artisan account:unlock username
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



<h2> Lock Account manualy</h2>

Lock account with Console artisan

```
php artisan account:lock username
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

<h2> View Login Attemps</h2>

View lock account with Console artisan

php artisan account:attemps username

```php
use Lockout;
use Request;

class UserManage {
	public function account_unlock(Request $request){
        Lockout::showAttemps($request->email);
        return redirect()->back();
    }
}
```



## Contributing

1. Fork it (<https://github.com/irfaardy/lockout-account/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some Feature'`)
4. Push to the branch (`git push origin master)
5. Create a new Pull Request
***

