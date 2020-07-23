
# 🔒 **JSON Lockout Account  for  Laravel**
 
[![Code Climate](https://codeclimate.com/github/irfaardy/lockout-account/badges/gpa.svg)](https://codeclimate.com/github/irfaardy/lockout-account)
 [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/irfaardy/lockout-account/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/irfaardy/lockout-account/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/irfaardy/lockout-account/badges/build.png?b=master)](https://scrutinizer-ci.com/g/irfaardy/lockout-account/build-status/master) [![Support me](https://img.shields.io/badge/Support-Buy%20me%20a%20coffee-yellow.svg?style=flat-square)](https://www.buymeacoffee.com/OBaAofN) [![Latest Stable Version](https://flat.badgen.net/packagist/v/irfa/lockout/latest?label=Version)](//packagist.org/packages/irfa/lockout) ![PHP Composer](https://github.com/irfaardy/lockout-account/workflows/PHP%20Composer/badge.svg?branch=master)
<a href="https://www.buymeacoffee.com/OBaAofN" target="_blank"><img width="130px" src="https://cdn.buymeacoffee.com/buttons/lato-red.png" alt="Buy Me A Coffee"  ></a>

 <img  src="https://repository-images.githubusercontent.com/261060616/13331f80-c9e6-11ea-8e73-73ad96ceb0a6" alt="Logo"  >
This package is useful for locking an account if someone tries to log into your account, this package can be implemented into the admin dashboard login, information system, cloud, etc.


<h3>🛠️ Installation with Composer </h3>

```php
composer require irfa/lockout
```

>You can get Composer <a href="https://getcomposer.org/download/" target="_blank">here</a>

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


    php artisan vendor:publish --tag=lockout-account

Open .env file and add this line (optional)

```php
....
LOGIN_ATTEMPS=3
LOGGING=true
    
```
<h2>Usage:</h2>
<a href="https://github.com/irfaardy/lockout-account/wiki/Usage">https://github.com/irfaardy/lockout-account/wiki/Usage</a>

------

## How to Contributing

1. Fork it (<https://github.com/irfaardy/lockout-account/fork>)
3. Commit your changes (`git commit -m 'Add some Feature'`)
4. Push to the branch (`git push origin version`)
5. Create a new Pull Request
***

**LICENSE**<br>
<a href="https://github.com/irfaardy/lockout-account/blob/master/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/irfaardy/lockout-account?style=for-the-badge"></a>

