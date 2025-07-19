# reactphp-x

reactphp-x基于 laravel-zero 和 reactphp 的异步web框架

## install

```bash
composer create-project reactphp-x/reactphp-x dev-master -vvv
```


## config

cp .env.example .env

## run

```
php artisan reactphp:http start
```

## visit

http://127.0.0.1:8000


## Documentation

### Route

routes/api.php

```php
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

// Route::get('/controller', 'App\Http\Controllers\IndexController@index');

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

Route::middleware($middlware1,$middlware2)->group('/users', function () {
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
```

### Middleware

```php
use App\Http\Middlewares\ExampleMiddleware;

Route::middleware(ExampleMiddleware::class)->group('/users', function () {
    Route::get('/', function (ServerRequestInterface $request) {
        return Response::plaintext(
            "Hello wörld!\n"
        );
    });
});
```

### Request Params

```php
// 获取请求头
$serverParams = $request->getServerParams();
// 获取请求参数
$queryParams = $request->getQueryParams();
// Content-Type: application/x-www-form-urlencoded or Content-Type: multipart/form-data
$name = $request->getParsedBody()['name'] ?? 'World';
// Content-Type: application/json
$data = json_decode((string)$request->getBody());

```

### Controller

```php
use App\Http\Controllers\ExampleController;

Route::get('/example', ExampleController::class.'@index');

```



### cron

routes/cron.php 默认开启，在 `config/cron.php` 设置 `enabled=false` 关闭

```php
/**
 *  Finds next execution time(stamp) parsin crontab syntax.
 *
 * @param string $crontab_string :
 *   0    1    2    3    4    5
 *   *    *    *    *    *    *
 *   -    -    -    -    -    -
 *   |    |    |    |    |    |
 *   |    |    |    |    |    +----- day of week (0 - 6) (Sunday=0)
 *   |    |    |    |    +----- month (1 - 12)
 *   |    |    |    +------- day of month (1 - 31)
 *   |    |    +--------- hour (0 - 23)
 *   |    +----------- min (0 - 59)
 *   +------------- sec (0-59)
 */
new Crontab('* * * * * *', function () {
    echo 'every_second: '. date('Y-m-d H:i:s') . "\n";
});
```

### 异步ORM

请参考 https://github.com/reactphp-x/orm，该项目已集成

使用之前先配置数据库
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=123456
DB_DATABASE=xxxx
```

## License

MIT
