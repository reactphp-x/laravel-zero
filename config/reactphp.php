<?php
return [
    'server' => [
        'route_file' => base_path('routes/api.php'),
        'public_path' => base_path('public'),
        'options' => [
            'pid_file' => env('REACTPHP_PID_FILE', base_path('storage/logs/reactphp_server.pid')),
            'log_file' => env('REACTPHP_LOG_FILE', base_path('storage/logs/reactphp_server.log')),
            'daemonize' => env('REACTPHP_HTTP_DAEMONIZE', false),
        ],
    ],
    'middlewares' => explode(',', env('REACTPHP_MIDDLEWARES', '')) ?: []
];
