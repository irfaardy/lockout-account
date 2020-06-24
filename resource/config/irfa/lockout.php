<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Login Attemps
    |--------------------------------------------------------------------------
    | limit failed login, default : 3
    */
    'login_attemps' => env('LOGIN_ATTEMPS', 3),
    
    /*
    |--------------------------------------------------------------------------
    | LOCKOUT Driver
    |--------------------------------------------------------------------------
    | for now only supported file and database
    | if you choose database you have to migrate first.
    | default : file
    */

    'driver' => env('LOCKOUT_DRIVER', 'file'),
    /*
    |--------------------------------------------------------------------------
    | Match IP Address
    |--------------------------------------------------------------------------
    */

    'match_ip' => false,
    /*
    |--------------------------------------------------------------------------
    | File path
    |--------------------------------------------------------------------------
    | For file lockout driver only
    | default storage_path('lockout/account/locked/')
    */

    'lockout_file_path' => storage_path('lockout/account/locked/'),
    /*
    |--------------------------------------------------------------------------
    | Redirect Url
    |--------------------------------------------------------------------------
    | For file lockout driver only
    | default storage_path('lockout/')
    */

    'redirect_url' => url("/login"),
];
