<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('sandboxe28640cb41bd42e1b1744396ffc59b8e.mailgun.org'),
        'secret' => env('key-9f5b1f1aa747e761493df3083a87de9a'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => 'AVcz6koiIqBh-TM9u-pULWViCeIaCj5X6iNoiYtMNM-Pqu-y7yL7wRtohX7WaoKwPXZwgVibk5uP3Swq',
        'secret' => 'EEFXsIWHQjaD5qshY1Da7xvawC0Hs998cpfJDPtFO4wDHk3nVkzDoqJqOtIYjTz5-CnIMCOQWVfKY3nJ'
    ],

];
