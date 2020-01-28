<?php

namespace App\Models;

use Mild\Database\Entity\Model;
use Mild\Contract\Database\Exceptions\CompilerExceptionInterface;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var self
     */
    private static $current;

    /**
     * @return Model
     * @throws CompilerExceptionInterface
     */
    public static function current()
    {
        if (!self::$current && ($user = self::where('id', '=', session()->get('user_id'))->first())) {
            self::$current = $user;
        }

        return self::$current;
    }
}