<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
       'user_id', 'server_uuid','name','game_id','template_id'
    ];


    protected $hidden = [
        'user_id','game_id'
    ];


    public function template()
    {
        return $this->belongsTo(Template::class);
    }


}
