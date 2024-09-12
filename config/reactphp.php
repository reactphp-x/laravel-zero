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
    'middlewares' => array_merge(array_filter(explode(',', env('REACTPHP_MIDDLEWARES', ''))) ?: [], [
        // \App\Http\Middlewares\CrosMiddleware::class,
        \App\Http\Middlewares\TrustedProxyMiddleware::class,
        new \FrameworkX\AccessLogHandler(),
        new \FrameworkX\ErrorHandler()
    ])
];
