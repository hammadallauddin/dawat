<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\User;
use App\Payment;
use Illuminate\Support\Facades\Session;
use App\Booking;

class PaymentController extends Controller
{
    public function payment_info(Request $request)
    {
    	$transaction_id = $request->tx;
    	$amount = $request->amt;
    	$currency_code = $request->cc;
    	$user_id = $request->item_number;

    	$payment = new Payment;
//    	$payment->create(['transcation_id'=>$transcation_id, 'amount'=>$amount, 'currency_code'=>$currency_code, 'user_id'=>$user_id]);
        $payment->transaction_id       = $transaction_id;
        $payment->amount      = $amount;
        $payment->currency_code = $currency_code;
        $payment->user_id      = $user_id;
        $payment->save();

    	$user = User::find($user_id);
    	$user->is_active = 1;
    	$user->save();

    	Session::flash('activated','Your account has been activated');
    	return redirect('/user/login');
    }

    public function book_payment(Request $request)
    {
        $transaction_id = $request->tx;
        $amount = $request->amt;
        $currency_code = $request->cc;
        $booking_id = $request->item_number;

        $payment = new Payment;
//      $payment->create(['transcation_id'=>$transcation_id, 'amount'=>$amount, 'currency_code'=>$currency_code, 'user_id'=>$user_id]);
        $payment->transaction_id       = $transaction_id;
        $payment->amount      = $amount;
        $payment->currency_code = $currency_code;
        $payment->booking_id      = $booking_id;
        $payment->save();

        $booking = Booking::find($booking_id);
        $booking->is_confirmed = 1;
        $booking->save();

        Session::flash('activated','Your booking has been confirmed');
        return redirect('/');
    }
}
