<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegEventDetails extends Model
{
    protected $fillable = [
      'user_id','event_id','dependent_id','course','location','fees','transaction_id'
    ];

    protected $table = 'sirtts_payments_details';
}
