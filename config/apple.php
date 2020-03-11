<?php

return [
    'passphrase' => env('APPLE_PASSPHRASE', 'E507e507'),

    'pem_path' => env('APPLE_PEM_PATH', '../apple/ck.pem'),

    'server' => env('APPLE_SERVER', 'ssl://gateway.sandbox.push.apple.com:2195'),
];
