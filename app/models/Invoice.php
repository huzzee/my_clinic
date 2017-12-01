<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','grand_total','paid','balance','prescriptions','invoice_code',
        'total_gst','after_discount','total_discount','net_total','invoice_comment','queue_id'
    ];

    protected $casts = [
        'prescriptions' => 'array'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function queues()
    {
        return $this->belongsTo('App\models\Queue','queue_id');
    }
}
