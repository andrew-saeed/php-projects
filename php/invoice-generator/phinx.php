<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'invoice-generator-mysql',
            'name' => 'invoice-generator',
            'user' => 'invoice-generator',
            'pass' => 'invoice-generator',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'invoice-generator',
            'user' => 'invoice-generator',
            'pass' => 'invoice-generator',
            'port' => '13306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'invoice-generator',
            'user' => 'invoice-generator',
            'pass' => 'invoice-generator',
            'port' => '13306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
