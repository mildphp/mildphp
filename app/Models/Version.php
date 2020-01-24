<?php

namespace App\Models;

use Mild\Database\Entity\Model;

class Version extends Model
{
    /**
     * @var string
     */
    protected $table = 'versions';

    /**
     * @return Model
     * @throws \Mild\Contract\Database\Exceptions\CompilerExceptionInterface
     */
    public static function current()
    {
        return self::orderBy('id', 'desc')->first();
    }
}