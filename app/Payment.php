<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['transaction_id','user_id','currency_code','amount','booking_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
