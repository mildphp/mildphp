<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Version;
use Mild\Http\ServerRequest;
use Mild\Support\Facades\ViewVariable;
use Mild\Contract\Database\Exceptions\CompilerExceptionInterface;

class ShareVariableToViewMiddleware
{
    /**
     * @param ServerRequest $request
     * @param $next
     * @return mixed
     * @throws CompilerExceptionInterface
     */
    public function __invoke(ServerRequest $request, $next)
    {
        ViewVariable::set('user', User::current());
        ViewVariable::set('version', Version::current());

        return $next($request);
    }
}