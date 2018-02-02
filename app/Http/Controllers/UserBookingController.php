<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\CreateBooking;
use App\Http\Requests\CreateUser;
use App\Http\Requests\RequestBooking;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestBooking $request)
    {
        $booked = User::findOrFail(Session::get('UserLoggedIn')->id)->halls->bookings->where('date',$request->date)->first();
        $hall = User::findOrFail(Session::get('UserLoggedIn')->id)->halls->id;
        $now = strtotime(Carbon::now())+600000;
        $target = strtotime($request->date);

        if($request->is_confirmed == null){
            $confirmed = 0;
        }
        else{
            $confirmed = 1;
        }

        if($booked == null) {
            if($now<$target){
                Booking::create(['fname'=>$request->first_name,'lname'=>$request->last_name,'contact'=>$request->contact,'nic'=>$request->nic,'date'=>$request->date,'email'=>$request->email,'is_confirmed'=>$confirmed,'hall_id'=>$hall]);
                Session::flash('created','Booking has been created');
                return redirect('/user/dashboard');
            }
            else{
                return redirect('/user/booking/create')->withErrors(['cannot book'=>'Cannot book within 7 days']);
            }
        }
        else{
            return redirect('/user/booking/create')->withErrors(['booked'=>'Day already reserved']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        if($booking->hall->user->id == Session::get('UserLoggedIn')->id)
            return view('user.booking.show',compact('booking'));
        else{
            return redirect('user/dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        if($booking->hall->user->id == Session::get('UserLoggedIn')->id)
            return view('user.booking.edit',compact('booking'));
        else{
            return redirect('user/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestBooking $request, $id)
    {
        $booked = Booking::findOrFail($id);
        if($request->is_confirmed == null){
            $confirmed = 0;
        }
        else{
            $confirmed = 1;
        }
        $booked->update(['fname'=>$request->first_name,'lname'=>$request->last_name,'contact'=>$request->contact,'nic'=>$request->nic,'date'=>$request->date,'email'=>$request->email,'is_confirmed'=>$confirmed]);
        Session::flash('updated','Booking has been updated');
        return redirect('/user/booking/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        if($booking->hall->user->id == Session::get('UserLoggedIn')->id) {
            $booking->delete();
            Session::flash('deleted','Booking has been deleted');
            return redirect('/user/dashboard');
        }

        else{
            return redirect('user/dashboard');
        }
    }

    public function showPending(){
        $pendings = Booking::where('is_confirmed',0)->get();
        return view('user.booking.pending',compact('pendings'));
    }

    public function confirmBooing($id){
        $booking =  Booking::findOrFail($id);

        $booking->update(['is_confirmed'=>1]);
        $data = [
            'title' => 'Booking Confirmed',
            'content' => 'Dear ' .$booking->fname.' '.$booking->lname.' your booking has been confirmed',
        ];

        Mail::send('consumer.mail',$data,function ($message) use ($booking) {
            $message->to($booking->email,$booking->fname.' '.$booking->lname)->subject('Booking Confirmed');
        });
        Session::flash('confirmed','Booking has been confirmed');
        return redirect('/user/pendingBooking');
    }
}
