<?php

use ReactphpX\LaravelReactphp\Facades\Route;
use React\Http\Message\Response;

Route::get('/', function () {
    return Response::plaintext(
        "Hello wörld!\n"
    );
});