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

Route::get('/', 'WelcomeController.index')->name('welcome');
Route::post('/login', 'AuthController.login')->name('login');
Route::put('/logout', 'AuthController.logout')->name('logout');
Route::prefix('/forgot')->group(function ($route) {
    $route->get('/', 'AuthController.resetPassword')->name('reset_password.token');
    $route->put('/', 'AuthController.resetPasswordAction')->name('reset_password.action');
    $route->post('/', 'AuthController.reset')->name('reset_password');
});
Route::prefix('/docs/{version?}')->middleware(DocsRedirectToCurrentVersionMiddleware::class)->group(function ($route) {
    $route->get('/', 'DocsController.index')->name('docs');
    $route->get('{package}', 'DocsController.show')->name('docs.detail');
});