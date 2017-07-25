<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
    	'name',
    	'description',
    	'prefix',
    	'tow_start_count'
    ];

}
