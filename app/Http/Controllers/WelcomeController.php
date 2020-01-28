<?php

namespace App\Http\Controllers;

use Mild\View\Engine;

class WelcomeController
{
    /**
     * @return Engine
     */
    public function index()
    {
        return view('welcome');
    }
}