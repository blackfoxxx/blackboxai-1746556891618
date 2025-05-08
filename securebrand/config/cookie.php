<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cookie Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default settings for cookies used by your
    | application. These settings will be applied to all cookies unless
    | overridden on a per-cookie basis.
    |
    */

    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
    'same_site' => 'lax',

];
