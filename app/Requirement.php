<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Requirement extends Model
{
    protected $guarded = [
    ];  
    
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    
    public function location()
    {
        return Location::find($this->location_id);
    }
}
