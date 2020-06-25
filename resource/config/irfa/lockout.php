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
    | Logging
    |--------------------------------------------------------------------------
    | Write log if login fail
    */
    'logging' => env('LOGGING', 3),
    /*
    |--------------------------------------------------------------------------
    | Input name
    |--------------------------------------------------------------------------
    | for now only supported file and database
    | if you choose database you have to migrate first.
    | default : file
    */

    'input_name' => "email",
   
    /*
    |--------------------------------------------------------------------------
    | File path
    |--------------------------------------------------------------------------
    | For file lockout driver only
    | default storage_path('lockout/')
    */

    'lockout_file_path' => storage_path('lockout/account/locked/'),
    /*
    |--------------------------------------------------------------------------
    | Redirect Url
    |--------------------------------------------------------------------------
    | For file lockout driver only
    | default '/login';
    */

    'redirect_url' => "/login",
    /*
    |--------------------------------------------------------------------------
    | Protected URL Path
    |--------------------------------------------------------------------------
    | Protect your login action url path
    | example: ['login','admin/login']
    | POST method Only
    */
    'protected_action_path' => ["login"],
    /*
    |--------------------------------------------------------------------------
    | Protected Middleware Group
    |--------------------------------------------------------------------------
    | Protect your  middleware Group
    | example: ['web','api']
    | POST method Only
    */
    'protected_middleware_group' => ["web"],
    /*
    |--------------------------------------------------------------------------
    | Message Name
    |--------------------------------------------------------------------------
    | Protect your  middleware Group
    | example: ['web','api']
    | POST method Only
    */
    'message_name' => "message",


];
