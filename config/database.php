<?php

return[
    'fetch' => PDO::FETCH_OBJ,
    'driver' => 'mysql',
    'mysql' => [
        'host' => '127.0.0.1',
        'user' => 'root',
        'pass' => '',
        'db' => 'autentifikacija',
        'charset' => 'utf8',
        'collation' => 'utf8_genaral_ci'
    ],
    'sqlite' => [
        'db' => 'autentifikacija'
    ],
    'pgsql' =>[
        'host' => '127.0.0.2',
        'user' => 'root2',
        'pass' => 'pass',
        'db' => 'autentifikacija',
        'charset' => 'utf8',
        'collation' => 'utf8_genaral_ci'
    ]
]

?>