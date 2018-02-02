<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{

    public $timestamps = false;
    protected $fillable = ['name','contact','desc','capacity','min_price','max_price','area_id'];


    public function user(){
        return $this->belongsTo('App\User');
    }


    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }


    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
