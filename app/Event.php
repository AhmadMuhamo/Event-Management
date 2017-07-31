<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name','description','start_date','end_date','location','fees','start_time','end_time','event_type'
    ];

    protected $table = 'sirtts_events';
}


