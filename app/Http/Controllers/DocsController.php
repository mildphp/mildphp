<?php

namespace App\Http\Controllers;

use Mild\View\Engine;

class DocsController
{
    /**
     * @return Engine
     */
    public function index()
    {
        return view('docs.index');
    }

    /**
     * @param $version
     * @param $package
     * @return Engine
     */
    public function show($version, $package)
    {
        return view('docs.detail');
    }
}