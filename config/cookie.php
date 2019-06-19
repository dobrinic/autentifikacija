<?php

return [
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiery' => 60*60*24*7 // tjedan dana u sekundama
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token'
    ]
]

?>