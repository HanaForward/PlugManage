<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlugStorage extends Model
{

    public $timestamps = false;


    protected $fillable = [
        'plug_id', 'version', 'data',
    ];
    protected $hidden = [
        'plug_id','created_at',
    ];

}
