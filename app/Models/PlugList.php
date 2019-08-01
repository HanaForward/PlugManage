<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugList extends Model
{
    public $timestamps = false;

    protected $fillable = [
       'user_id', 'plug_id','game_id','created_at',
    ];

    protected $hidden = [
        'user_id', 'plug_id','game_id',
    ];


    public function plug()
    {

        return $this->belongsTo('App\Models\PlugShop');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
