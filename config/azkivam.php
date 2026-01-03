<?php

return [
    'api_key' => env('AZKIVAM_API_KEY'),
    'username' => env('AZKIVAM_USERNAME'),
    'password' => env('AZKIVAM_PASSWORD'),
    'provider_id' => env('AZKIVAM_PROVIDER_ID'),
    'merchant_id' => env('AZKIVAM_MERCHANT_ID'),
    'base_url' => 'https://api.azkiloan.com/auth/authenticate',
    'request_url' => 'https://api.azkiloan.com/payment/purchase',
    'verify_url' => 'https://api.azkiloan.com/payment/verify',
];
