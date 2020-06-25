<?php
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\Lockout\Facades;

use Illuminate\Support\Facades\Facade;

class Lockout extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Irfa\Lockout\Func\LockoutFunc::class;
    }
}
