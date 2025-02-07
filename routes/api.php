<?php

use ReactphpX\LaravelReactphp\Facades\Route;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

Route::get('/', function (ServerRequestInterface $request) {
    return Response::plaintext(
        "Hello wörld!\n"
    );
});

$class = new class {
    public function index(ServerRequestInterface $request) {
        return Response::plaintext(
            "Hello wörld!\n"
        );
    }
};

Route::get('/at', get_class($class).'@index');

$middlware1 = function ($request, $next) {
    // todo middleware
    return $next($request);
};
$middlware2 = function ($request, $next) {
    // todo middleware
    return $next($request);
};
Route::group('/users', $middlware1, $middlware2, function () {
    Route::get('/', function (ServerRequestInterface $request) {
        return Response::plaintext(
            "Hello wörld!\n"
        );
    });
    Route::get('/{id}', function (ServerRequestInterface $request) {
        $id = $request->getAttribute('id');
        return Response::plaintext(
            "Hello wörld! $id\n"
        );
    });
});

Route::middleware($middlware1,$middlware2)->group('/users1', function () {
    Route::get('/', function (ServerRequestInterface $request) {
        return Response::plaintext(
            "Hello wörld!\n"
        );
    });
    Route::get('/{id}', function (ServerRequestInterface $request) {
        $id = $request->getAttribute('id');
        return Response::plaintext(
            "Hello wörld! $id\n"
        );
    });
});