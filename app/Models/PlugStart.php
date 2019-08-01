<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugStart extends Model
{
    public $timestamps = false;


    protected $fillable = [

    ];


    protected $hidden = [
        'id','user_id', 'plug_id','game_id','plug',
    ];


    public function plug()
    {
        return $this->belongsTo(PlugShop::class,'plug_id','id');
    }

}
