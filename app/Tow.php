<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tow extends Model
{
    protected $fillable = [
        'user_id',
        'tow_number'
    ];

    public function attachments(){
    	return $this->hasMany(Attachment::class);
    }
    
    public function photos(){
    	return $this->hasMany(Photo::class);
    }

    public function invoices(){
    	return $this->hasMany(Invoice::class);
    }

    public function children(){
        return $this->hasMany(Tow::class, 'parent_id', 'id');
    }
}
