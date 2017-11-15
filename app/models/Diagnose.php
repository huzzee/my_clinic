<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    protected $fillable=[
        'entity_id','diagnose_name'
    ];
}
