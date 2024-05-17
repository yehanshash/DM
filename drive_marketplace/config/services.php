<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => 'Ov23li9fVhck7BIclPNl', //Github API
        'client_secret' => '25f3bdd5feafc372be98e00870e544db4afa1252', //Github Secret
        'redirect' => 'http://localhost:8000/login/github/callback',
     ],
     'google' => [
        'client_id' => '702589886582-bgcimpu9aa613vqsggrmipflvsctmqn7.apps.googleusercontent.com', //Google API
        'client_secret' => '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', //Google Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
     ],
     'facebook' => [
        'client_id' => '#', //Facebook API
        'client_secret' => '#', //Facebook Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
     ],

];
