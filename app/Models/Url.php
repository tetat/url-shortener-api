<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
