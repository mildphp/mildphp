<?php

namespace App\Http\Middleware;

use App\Models\Version;
use Mild\Http\ServerRequest;

class DocsRedirectToCurrentVersionMiddleware
{
    /**
     * @param ServerRequest $request
     * @param $next
     * @return mixed
     * @throws \Mild\Contract\Database\Exceptions\CompilerExceptionInterface
     * @throws \Mild\Http\HttpException
     */
    public function __invoke(ServerRequest $request, $next)
    {
        $version = $request->getRoute()->getParameter('version');

        if (!$version || !in_array($version, Version::get()->map(function ($version) {
                return $version->name;
            })->all())) {

            if ($request->getRoute()->name() === 'docs') {
                return response()->redirect(route('docs', Version::current()->name));
            }

            return response()->redirect(route('docs.detail', [Version::current()->name, $request->getRoute()->getParameter('version')]));
        }

        return $next($request);
    }
}