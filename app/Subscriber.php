<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'event_id','user_id','dependent_id'
        ];

    protected $table = 'sirtts_subscribers';
}
