<?php

return [
    'paths' => ['api/*'], // Allow CORS only for API routes
    'allowed_methods' => ['*'], // Allow all methods (GET, POST, PUT, DELETE)
    'allowed_origins' => ['*'], // Allow all origins or replace with your frontend URL
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

