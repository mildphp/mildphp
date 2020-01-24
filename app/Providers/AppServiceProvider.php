<?php

namespace App\Providers;

use App\Models\Version;
use Mild\Support\ServiceProvider;
use Mild\Support\Facades\ViewVariable;

class AppServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @throws \Mild\Contract\Database\Exceptions\CompilerExceptionInterface
     */
    public function boot()
    {
        ViewVariable::set('version', Version::current());
    }
}