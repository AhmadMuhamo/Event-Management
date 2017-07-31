<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otrojah extends Model
{
    protected $fillable = [
      'user_id','event_id','dependent_id','batch','location','fees','transaction_id'
    ];

    protected $table = 'sirtts_payments_details';
}
