<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $fillable = [
    	'name',
    	'street_address',
    	'city',
    	'state',
    	'zipcode'
    ];
}
