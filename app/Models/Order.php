<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'plug_id','price','paytype','state',
    ];

    protected $hidden = [
        'id', 'user_id', 'plug_id','state'
    ];

}
