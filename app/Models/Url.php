<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    protected $fillable = [
        'url',
        'user_id',
        'originalUrl',
    ];

    protected $primaryKey = 'url';
    protected $keyType = 'string';
    public $incrementing = false;
}
