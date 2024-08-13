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

routes/api

```
Route::get('/', function () {
    return 'Hello World';
});
Route::group(['prefix' => 'api'], function () {
    Route::get('user', 'UserController@index');
    Route::get('user/{id}', 'UserController@show');
    Route::post('user', 'UserController@store');
    Route::put('user/{id}', 'UserController@update');
    Route::delete('user/{id}', 'UserController@destroy');
});
```


## License

MIT
