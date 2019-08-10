<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugShop extends Model
{
    protected $fillable = [
        'uuidShort','name','user_id','type','price','description','updated_at','game_id',
    ];

    protected $hidden = [
        'id','user_id','game_id','created_at'
    ];


    public function owner()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
