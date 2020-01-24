<?php

namespace App;

use Mild\Support\Arr;
use Mild\Http\ServerRequest;

class Localization
{
    /**
     * @var array
     */
    private static $locales = [
        'id',
        'en'
    ];

    /**
     * @param ServerRequest $request
     * @return string
     */
    public static function getLocaleFromRequest(ServerRequest $request)
    {
        if (in_array($locale = Arr::first(array_filter(explode('/', $request->getUri()->getPath()))), self::$locales)) {
            return $locale;
        }

        return '';
    }
}