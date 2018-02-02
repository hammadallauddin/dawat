<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Http\Requests\RequestBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Booking;

class ConsumerController extends Controller
{
    public function searchByName(Request $request){
        $this->validate($request, [
            'name' => 'required'
            ]);
        $halls = Hall::where('name','like',$request->name)->get();;
        return view('consumer.results',compact('halls'));
    }

    public function searchByRate(Request $request){
        $this->validate($request, [
            'min_rate' => 'required|numeric',
            'max_rate' => 'required|numeric'
        ]);
        if(($request->min_rate > 10000)&&($request->min_rate<$request->max_rate)){
            if($request->max_rate<2000000){
                $halls = Hall::where('min_price','>=',$request->min_rate)->where('max_price','<=',$request->max_rate)->get();
                return view('consumer.results',compact('halls'));
            }
            else{
                return redirect('/')->withErrors(['invalid_maximum_rate'=>'Maximum rate is invalid']);
            }
        }
        else{
            return redirect('/')->withErrors(['invalid_minimum_rate'=>'Minimum rate is invalid']);
        }
    }

    public function searchByArea(Request $request){
        if($request->city==null || $request->area==null){
            return redirect('/')->withErrors(['notSelected'=>'Option  not selected']);
        }
        else{
            $halls = Hall::where('area_id',$request->area)->get();
            return view('consumer.results',compact('halls'));
        }
    }

    public function searchByCapacity(Request $request){
        $this->validate($request, [
            'min_capacity' => 'required|numeric',
            'min_capacity' => 'required|numeric'
        ]);
        if($request->min_capacity > 100 && $request->max_capacity < 1000    && $request->min_capacity<$request->max_capacity){
            $halls = Hall::whereBetween('capacity', [$request->min_capacity, $request->max_capacity])->get();
            return view('consumer.results',compact('halls'));
        }
        else{
            return redirect('/')->withErrors(['invalid_capacity'=>'capacity is invalid']);
        }
    }


    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $areas = DB::table('areas')->where('city_id',$request->city)->get();
            $data = view('consumer/ajax-search-select',compact('areas'))->render();
            return response()->json(['options'=>$data]);
        }
    }


    public function bookingRequest(RequestBooking $request,$id){
        $booked = Hall::findOrFail($id)->bookings->where('date',$request->date)->first();

        $now = strtotime(Carbon::now())+600000;
        $target = strtotime($request->date);


        if($now<$target){
            if($booked == null) {
                $hall = Hall::findOrFail($id);
                $hall->bookings()->create(['fname'=>$request->first_name,'lname'=>$request->last_name,'contact'=>$request->contact,'nic'=>$request->nic,'date'=>$request->date,'email'=>$request->email,'is_confirmed'=>0]);
                Session::flash('submitted','Booking request has been submitted');
                
                $hall_name = $hall->name;
                $date = $request->date;
                $amount = 20000;
                $booking = Booking::where('hall_id',$hall->id)->where('date',$date)->first();
                $booking_id = $booking->id;
                $paypal = $hall->user->paypal_email;


                return response()->view('payments.bookingpayment', ['hall_name' => $hall_name, 'date' => $date, 'amount' => $amount, 'booking_id' => $booking_id, 'paypal' => $paypal]);
            }
            else{
                return redirect('/bookings/request/'.$id)->withErrors(['booked'=>'Day already reserved']);
            }
        }
        else{
            return redirect('/bookings/request/'.$id)->withErrors(['cannot book'=>'Cannot book within 7 days']);
        }
    }


    public function sendFeedback(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = [
            'title' => 'FEEDBACK',
            'name' => $request->name,
            'from' => $request->email,
            'content' => $request->message,
        ];

        Mail::send('consumer.feedback',$data,function ($message){
            $message->to('hammadallauddin@gmail.com', 'Feedback')->subject('Feedback');
        });
        return redirect('/');
    }
}
