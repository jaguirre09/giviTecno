<?php

use App\Config\DotEnvConfig;

$dotenv = new DotEnvConfig();
$dotenv->initConfigs();


return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'docker',
            'production' => [
                'adapter' => $_ENV["PRODUCTION_DB_ADAPTER"],
                'host' => $_ENV["PRODUCTION_DB_HOST"],
                'name' => $_ENV["PRODUCTION_DB_NAME"],
                'user' => $_ENV["PRODUCTION_DB_USER"],
                'pass' => $_ENV["PRODUCTION_DB_PASS"],
                'port' => $_ENV["PRODUCTION_DB_PORT"],
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => $_ENV["DEBUG_DB_ADAPTER"],
                'host' => $_ENV["DEBUG_DB_HOST"],
                'name' => $_ENV["DEBUG_DB_NAME"],
                'user' => $_ENV["DEBUG_DB_USER"],
                'pass' => $_ENV["DEBUG_DB_PASS"],
                'port' => $_ENV["DEBUG_DB_PORT"],
                'charset' => 'utf8',
            ],
            'docker' => [
                'adapter' => $_ENV["DOCKER_DB_ADAPTER"],
                'host' => $_ENV["DOCKER_DB_HOST"],
                'name' => $_ENV["DOCKER_DB_NAME"],
                'user' => $_ENV["DOCKER_DB_USER"],
                'pass' => $_ENV["DOCKER_DB_PASS"],
                'port' => $_ENV["DOCKER_DB_PORT"],
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
