<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'uuid', 'alias','user_id','game_id',
    ];

    protected $hidden = [
        'user_id','game_id',
    ];
}
