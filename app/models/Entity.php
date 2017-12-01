<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Entity extends Model
{
    protected $fillable=[
        'entity_name','entity_code','status','currency'
    ];

    protected $table = 'entities';

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function user_informations()
    {
        return $this->hasMany(UserInformation::class);
    }
}
