<?php
return [
    'auth_enabled' => false, // true to require authentication
    'auth_method' => 'apikey', // 'apikey', 'basic', 'jwt', 'oauth'
    'api_keys' => ['changeme123'],
    'basic_users' => ['admin' => 'secret'],
    'jwt_secret' => 'YourSuperSecretKey',
    'jwt_issuer' => 'yourdomain.com',
    'jwt_audience' => 'yourdomain.com',
    'oauth_providers' => [
        // 'google' => ['client_id' => '', 'client_secret' => '', ...]
    ]
];