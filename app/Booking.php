<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    public $timestamps = false;

    protected $fillable = ['fname','lname','contact','payment','hall_id','date','is_confirmed','nic','email'];

    public function hall(){
        return $this->belongsTo('App\Hall');
    }
}
