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