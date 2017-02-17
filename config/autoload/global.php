<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=album;host=localhost',
        'username' => 'root',
        'password' => 'tsi',
    ],

    'doctrine'        => [
        'connection'     => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params'      => [
                    'host'          => 'localhost',
                    'user'          => 'root',
                    'password'      => '',
                    'dbname'        => 'album',
                    'charset'       => 'utf8',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8'
                    ]
                ],
            ]
        ],

        'configuration'  => [
            'orm_default' => [
                'generate_proxies'   => true,
                'metadata_cache'     => 'array',
                'query_cache'        => 'array',
                'result_cache'       => 'array',
                'hydration_cache'    => 'array',
            ]
        ]
    ]
];
