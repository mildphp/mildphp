<?php

/*
|--------------------------------------------------------------------------
| Web Route (App\Providers\RouteServiceProvider)
|--------------------------------------------------------------------------
|
| Disini anda bisa mendefinisikan route. anda bisa menambahkan middleware
| sesuai kebutuhan anda, gunakan route cache untuk performance yang lebih
| baik ketika anda akan masuk dalam tahap production.
|
*/

use App\Http\Middleware\DocsRedirectToCurrentVersionMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::prefix('/docs/{version?}')->middleware(DocsRedirectToCurrentVersionMiddleware::class)->group(function ($route) {
    $route->get('/', function () {
        return view('docs.index');
    })->name('docs');
    $route->get('{package}', function () {
        return view('docs.detail');
    })->name('docs.detail');
});