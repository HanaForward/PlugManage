<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugList extends Model
{
    protected $fillable = [
        'id', 'plug_id','created_at',
    ];

    protected $hidden = [
        'id','user_id','user_id', 'plug_id'
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
