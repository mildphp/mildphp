<?php

namespace App\Http\Middleware;

use App\Localization;
use Mild\Http\ServerRequest;
use Mild\Support\Facades\Session;
use Mild\Support\Facades\Translation;

class LocalizationMiddleware
{
    /**
     * @param ServerRequest $request
     * @param $next
     * @return mixed
     */
    public function __invoke(ServerRequest $request, $next)
    {
        $locale = Localization::getLocaleFromRequest($request) ?: Session::get('_locale', Translation::getFallbackLocale());

        app()->setLocale($locale);
        Session::set('_locale', $locale);

        return $next($request);
    }
}