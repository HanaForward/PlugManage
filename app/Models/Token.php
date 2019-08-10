<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $fillable = [
        'token', 'alias','switch','bind','user_id','updated_at',
    ];

    protected $hidden = [
        'id','created_at','user_id','bind',
    ];

    public function getAuthIdentifier()
    {
        return $this->user_id;
    }




    public function user()
    {

        return $this->hasOne(User::class, 'user_id', 'id');

    }

    public function getAuthPassword()
    {
        return $this->user->password;
    }

    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->attributes) || $this->hasGetMutator($key)) {
            return $this->getAttributeValue($key);
        }
        return $this->getRelationValue($key);
    }




}