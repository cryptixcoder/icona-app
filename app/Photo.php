<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'filename',
        'notes'
    ];

    protected $appends = [
    	'fullpath'
    ];

    public function tow(){
    	return $this->belongsTo(Tow::class);
    }

    public function getFullpathAttribute(){
        return config('icona.buckets.photos') . $this->filename;
    }
}
