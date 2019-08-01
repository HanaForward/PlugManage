<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugShop extends Model
{
    protected $fillable = [
        'uuidShort','owner','type','price','description','updated_at','game_id',
    ];

    protected $hidden = [
        'id','game_id','created_at'
    ];

}
