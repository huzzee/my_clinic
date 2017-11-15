<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DrawingTemplate extends Model
{
    protected $fillable=[
        'entity_id','title','images'
    ];
}
