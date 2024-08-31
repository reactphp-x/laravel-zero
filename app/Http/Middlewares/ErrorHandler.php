<?php

namespace App\Http\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\Promise\PromiseInterface;
use FrameworkX\ErrorHandler as FrameworkXErrorHandler;

/**
 * @final
 */
class ErrorHandler extends FrameworkXErrorHandler
{

    /**
     * @return ResponseInterface|PromiseInterface<ResponseInterface>|\Generator
     *     Returns a response, a Promise which eventually fulfills with a
     *     response or a Generator which eventually returns a response. This
     *     method never throws or resolves a rejected promise. If the next
     *     handler fails to return a valid response, it will be turned into a
     *     valid error response before returning.
     * @throws void
     */
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            $response = $next($request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->errorInvalidException($e);
        }

        if ($response instanceof ResponseInterface) {
            return $response;
        } elseif ($response instanceof PromiseInterface) {
            return $response->then(function ($response) {
                if ($response instanceof ResponseInterface) {
                    return $response;
                } else {
                    return $this->errorInvalidResponse($response);
                }
            }, function ($e) {
                // Promise rejected, always a `\Throwable` as of Promise v3
                assert($e instanceof \Throwable || !\method_exists(PromiseInterface::class, 'catch')); // @phpstan-ignore-line
                \Log::error('promise: '.$e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                if ($e instanceof \Throwable) {
                    return $this->errorInvalidException($e);
                } else { // @phpstan-ignore-line
                    // @phpstan-ignore-next-line
                    return $this->errorInvalidResponse(\React\Promise\reject($e)); // @codeCoverageIgnore
                }
            });
        } elseif ($response instanceof \Generator) {
            return $this->coroutine($response);
        } else {
            return $this->errorInvalidResponse($response);
        }
    }
}