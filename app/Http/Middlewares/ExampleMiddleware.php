<?php

namespace App\Http\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Http\Message\Response;

class ExampleMiddleware
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {

        return $next($request);
    }
}