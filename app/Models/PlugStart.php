<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugStart extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'template_uuid','user_id', 'plug','switch'
    ];


    protected $hidden = [
        'id','user_id', 'plug','plug',
    ];


    public function plug()
    {
        return $this->belongsTo(PlugShop::class,'plug_id','id');
    }

}
