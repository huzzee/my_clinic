<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DrugCategory extends Model
{
    protected $fillable = [
        'category_name','status','entity_id'
    ];
}
