<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class ExampleController
{
    public function index(ServerRequestInterface $request)
    {
        // 获取请求头
        $serverParams = $request->getServerParams();
        // 获取请求参数
        $queryParams = $request->getQueryParams();
        // Content-Type: application/x-www-form-urlencoded or Content-Type: multipart/form-data
        $parsedBody = $request->getParsedBody();
        $name = $parsedBody['name'] ?? 'World';

        // Content-Type: application/json
        $data = json_decode((string)$request->getBody());

        return Response::json([
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'serverParams' => $serverParams,
                'queryParams' => $queryParams,
                'data' => $data,
            ],
        ]);
    }
}