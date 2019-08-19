<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugStorage extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id','plug_id', 'version', 'data',
    ];
    protected $hidden = [
        'user_id','plug_id','created_at',
    ];

}
