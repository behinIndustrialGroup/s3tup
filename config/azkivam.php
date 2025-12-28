<?php

return [
    'api_key' => env('AZKIVAM_API_KEY'),
    'base_url' => env('AZKIVAM_BASE_URL', 'https://api.azkivam.com'),
    'callback_url' => env('AZKIVAM_CALLBACK_URL'),

    'endpoints' => [
        'request' => env('AZKIVAM_REQUEST_ENDPOINT', '/v1/payment/request'),
        'verify' => env('AZKIVAM_VERIFY_ENDPOINT', '/v1/payment/verify'),
    ],
];
