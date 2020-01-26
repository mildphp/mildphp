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

use Mild\Http\ServerRequest;
use App\Http\Middleware\DocsRedirectToCurrentVersionMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/login', function (ServerRequest $request) {
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required'
    ]);
})->name('login');

Route::prefix('/docs/{version?}')->middleware(DocsRedirectToCurrentVersionMiddleware::class)->group(function ($route) {
    $route->get('/', function () {
        return view('docs.index');
    })->name('docs');
    $route->get('{package}', function () {
        return view('docs.detail');
    })->name('docs.detail');
});