<?php

return [

    'core' => [
        'minPhpVersion' => '7.4.0',
    ],
    'final' => [
        'key' => true,
        'publish' => false,
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'Redis',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    'permissions' => [
        'storage/framework/' => '755',
        'storage/logs/' => '755',
        'bootstrap/cache/' => '755',
    ],

    'environment' => [
        'form' => [
            'fields' => [
                'base' => [
                    'APP_NAME',
                    'APP_ENV' => [
                        'local' => 'local',
                        'developement' => 'developement',
                        'qa' => 'qa',
                        'production' => 'production',
                    ],
                    'APP_DEBUG' => [
                        1 => 'true',
                        0 => 'false',
                    ],
                    'APP_URL',
                ],
                'database' => [
                    'DB_CONNECTION' => [
                        'mysql' => 'mysql',
                        'sqlite' => 'sqlite',
                        'pgsql' => 'pgsql',
                        'sqlsrv' => 'sqlsrv'
                    ],
                    'DB_HOST',
                    'DB_PORT' => 'number',
                    'DB_DATABASE' => '',
                    'DB_USERNAME',
                    'DB_PASSWORD' => 'password',
                    'DB_TABLE_PREFIX',
                ],
                'app' => [
                    'cache' => [
                        'BROADCAST_DRIVER',
                        'CACHE_DRIVER',
                        'QUEUE_CONNECTION',
                        'SESSION_DRIVER',
                    ],
                    'redis' => [
                        'REDIS_HOST',
                        'REDIS_PASSWORD' => 'password',
                        'REDIS_PORT',
                    ],
                    'mail' => [
                        'MAIL_MAILER',
                        'MAIL_HOST',
                        'MAIL_PORT',
                        'MAIL_USERNAME',
                        'MAIL_PASSWORD',
                        'MAIL_ENCRYPTION',
                    ],
                ],
            ],
            'rules' => [
                'APP_NAME' => 'required|string|max:50',
                'APP_ENV' => 'required|string|max:50',
                'APP_URL' => 'required|url',
                'DB_CONNECTION' => 'required|string|max:50',
                'DB_HOST' => 'required|string|max:50',
                'DB_PORT' => 'required|numeric',
                'DB_DATABASE' => 'required|string|max:50',
                'DB_USERNAME' => 'required|string|max:50',
                'DB_PASSWORD' => 'nullable|string|max:50',
                'DB_TABLE_PREFIX' => 'nullable|string|max:50',
                'BROADCAST_DRIVER' => 'required|string|max:50',
                'CACHE_DRIVER' => 'required|string|max:50',
                'QUEUE_CONNECTION' => 'required|string|max:50',
                'SESSION_DRIVER' => 'required|string|max:50',
                'REDIS_HOST' => 'required|string|max:50',
                'REDIS_PASSWORD' => 'nullable|string|max:50',
                'REDIS_PORT' => 'required|numeric',
                'MAIL_MAILER' => 'nullable|string|max:50',
                'MAIL_HOST' => 'nullable|string|max:50',
                'MAIL_PORT' => 'nullable|string|max:50',
                'MAIL_USERNAME' => 'nullable|string|max:50',
                'MAIL_PASSWORD' => 'nullable|string|max:50',
                'MAIL_ENCRYPTION' => 'nullable|string|max:50',
            ],
        ],
    ],

    'installed' => [
        'redirectOptions' => [
            'route' => [
                'name' => 'admin.index',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump' => [
                'data' => 'No Message',
            ],
        ],
    ],

    'installedAlreadyAction' => '',

    'updaterEnabled' => 'true',

];
