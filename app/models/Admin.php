<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'full_name','user_id','gender','status','country',
        'contact_no','address','account_no'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
