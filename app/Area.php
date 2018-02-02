<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','city_id'];


    public function city(){
        return $this->belongsTo('App\City');
    }


    public function halls(){
        return $this->hasMany('App\Hall');
    }

}
