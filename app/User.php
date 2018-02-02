<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = ['password','fname','lname','username','email','contact','is_active','is_verified','verify_mail', 'fees','expire','paypal_email'];


    public function halls(){
        return $this->hasOne('App\Hall');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
