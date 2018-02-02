<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'file' , 'hall_id'
    ];

    protected $uploads = '/images/halls/';

    public function halls(){
        return $this->belongsTo('App\Hall');
    }
}
