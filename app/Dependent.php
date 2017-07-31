<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $fillable = [
        'user_id','first_name','last_name','email','phone_number','gender','relation',
    ];

    protected $table = 'sirtts_dependents';
}
