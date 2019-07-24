<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugShop extends Model
{
    protected $fillable = [
        'uuidShort', 'owner','type','price','description','updated_at',
    ];

    protected $hidden = [
        'id','game','created_at'
    ];

}
