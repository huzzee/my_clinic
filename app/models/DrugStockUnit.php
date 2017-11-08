<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DrugStockUnit extends Model
{
    protected $fillable = [
        'unit_name','status','entity_id'
    ];
}
