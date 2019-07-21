<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugShop extends Model
{
    protected $fillable = [
        'uuid', 'owner','type','price','version','description','updated_at',
    ];

    protected $hidden = [
        'id','uuid','game','created_at'
    ];

}
