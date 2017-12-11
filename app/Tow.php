<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Tow extends Model
{
    use Searchable;
    
    protected $fillable = [
        'user_id',
        'contract_id',
        'tow_number',
        'make',
        'model',
        'year',
        'vehicle_color',
        'state',
        'tag_number',
        'vin',
        'mileage',
        'officer_id',
        'lot_id',
        'complaint_id',
        'vehicle_owner',
        'phone',
        'location',
        'tags',
        'lot_id',
        'archived',
        'reason_id',
        'released',
        'notes'
    ];

    protected $appends = [
        'tow_time'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeParents($query){
        return $query->where('parent_id', null);
    }

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

    public function getTowTimeAttribute(){
        return $this->created_at->format('h:i a');
    }

    public function scopeActive($query){
        return $query->where('archived', false);
    }

    public function scopeArchived($query){
        return $query->where('archived', true);
    }

    public function scopeLastUpdated($query){
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeContract($query, $id){
        return $query->where('contract_id', $id);
    }

    public function scopePrivate($query){
        return $query->where('contract_id', NULL);
    }

    public function lot(){
        return $this->belongsTo(Lot::class);
    }

    public function reason(){
        return $this->belongsTo(Reason::class);
    }
}
