<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'id', 'gameid', 'gamename',
    ];

    public function categories()
    {
        if (is_null(cache('Games_Cache'))) {
            cache(['Games_Cache' => $this->all()], 480);
        }
        return cache('Games_Cache');
    }

}
