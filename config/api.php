<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | This is required to make api calls. Without it the system will
    | respond with unauthenticated
    |
    */

    'key' => env('API_KEY', '123'),

    /*
    |--------------------------------------------------------------------------
    | API Live
    |--------------------------------------------------------------------------
    |
    | If the API is not live it will not get the last hours worth of data
    | and just down sample all of the data it has in the database
    |
    */

    'live' => env('API_LIVE', false),
];
