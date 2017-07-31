<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'event_id','type','fee','currency','discount','applicants'
    ];

    protected $table = 'sirtts_fees';
}
