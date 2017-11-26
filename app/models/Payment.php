<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','invoice_id','paid_amount','payment_method','prescriptions','receipt_no'
    ];

    protected $casts = [
        'prescriptions' => 'array'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function invoices()
    {
        return $this->belongsTo('App\models\Invoice','invoice_id');
    }
}
