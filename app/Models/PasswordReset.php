<?php

namespace App\Models;

use Mild\Database\Entity\Model;
use Mild\Database\Entity\Relations\BelongsTo;

class PasswordReset extends Model
{
    /**
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * @var array
     */
    protected $dateAttributes = [
        'expired_at' => 'Y-m-d H:i:s'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}