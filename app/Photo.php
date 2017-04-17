<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [];

    public function tow(){
    	return $this->belongsTo(Tow::class);
    }
}
