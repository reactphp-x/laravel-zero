# reactphp-x


## install

```bash
composer create-project reactphp-x/reactphp-x -vvv
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
```


## License

MIT
