<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegEvent extends Model
{
   protected $table = 'sirtts_registration_events';

   protected $fillable = [
        'event_id','course','fees','currency','location'
    ];
}
