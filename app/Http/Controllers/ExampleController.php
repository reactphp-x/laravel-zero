<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class ExampleController
{
    public function index(ServerRequestInterface $request)
    {
        return Response::plaintext(
            "Hello wörld!\n"
        );
    }
}