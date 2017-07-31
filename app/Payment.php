<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
      'status','payment_id','payer_id','amount','user_id','payment_method','refund_url','event_id'
    ];

    protected $table = 'sirtts_payments';
}
