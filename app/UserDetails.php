<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\UserController;
class UserDetails extends Model
{

    protected $fillable = [
        'user_id','first_name', 'last_name','gender','birth_date','primary_phone',
        'other_phone','country','city','postal_code','address','address_lie2','billing_address','billing_address_line2',
    ];

	protected $table = 'sirtts_user_details';
}