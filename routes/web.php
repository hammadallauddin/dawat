<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Admin;
use App\Booking;
use App\City;
use App\Hall;
use App\User;
use Carbon\Carbon;
use Chencha\Share\Share;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


Route::get('/', function () {
    $cities = City::Pluck('name','id')->all();
    return view('consumer.index',compact('cities'));
});

Route::get('/facebook',function (){
    return \Share::load('http://www.twitter.com', 'My example')->twitter();
})->name('consumer.facebook');


Route::get('/details/{id}',function ($id){
    $hall = Hall::findOrFail($id);
    return view('consumer.details',compact('hall'));
})->name('consumer.details');

Route::post('/consumer/feedback', ['as'=>'consumer.feedback','uses'=>'ConsumerController@sendFeedback']);


Route::get('/bookings/{id}',function ($id){

    $events = [];

    $data = Hall::findOrFail($id)->bookings;

    if($data->count()){

        foreach ($data as $key) {
            if($key->is_confirmed == 1){
                $events[] = Calendar::event(

                    'Booked',

                    true,

                    new \DateTime(new Carbon($key->date)),

                    new \DateTime(new Carbon($key->date)),

                    ['id' => $key->id]
                );
            }

        }
    }
    $calendar = Calendar::addEvents($events);

    $hall = Hall::findOrFail($id);

    return view('consumer.bookings',compact('hall','calendar'));
})->name('consumer.bookings');

Route::get('/bookings/request/{id}',function ($id){
    $hall = Hall::findOrFail($id);
    return view('consumer.request',compact('hall'));
})->name('booking.request');

Route::post('/bookings/request/{id}', ['as'=>'booking.requests','uses'=>'ConsumerController@bookingRequest']);


Route::post('ajax-search-select', ['as'=>'consumer.ajax-search-select','uses'=>'ConsumerController@selectAjax']);
Route::post('/searchByName', ['as'=>'searchByName','uses'=>'ConsumerController@searchByName']);
Route::post('/searchByRate', ['as'=>'searchByRate','uses'=>'ConsumerController@searchByRate']);
Route::post('/searchByArea', ['as'=>'searchByArea','uses'=>'ConsumerController@searchByArea']);
Route::post('/searchByCapacity', ['as'=>'searchByCapacity','uses'=>'ConsumerController@searchByCapacity']);


//login for admin
Route::get('/admin',function (){
    return redirect('/admin/login');
});
Route::get('/admin/login',['uses'=>'LoginController@admin','as'=>'admin.login']);
Route::post('admin/login/', ['uses'=>'LoginController@storeAdmin','as'=>'admin.login']);


//login for vendor
Route::get('/user',function (){
    return redirect('/user/login');
});
Route::get('/user/login',['uses'=>'LoginController@user','as'=>'user.login']);
Route::post('user/login/', ['uses'=>'LoginController@storeUser','as'=>'user.login']);

Route::get('/user/signup',['uses'=>'LoginController@signup','as'=>'user.signup']);
Route::post('user/signup/', ['uses'=>'LoginController@createUser','as'=>'user.signup']);
Route::post('select-area', ['as'=>'select-area','uses'=>'LoginController@selectAjax']);

Route::get('/user/verify',function (){
    return view('user.login.verify');
});

Route::post('user/verify/', ['uses'=>'LoginController@verifyUser','as'=>'user.verify']);




Route::group(['middleware'=>'ChkUser'],function(){

    Route::get('user/dashboard',function(){

        $events = [];

        $data = User::findOrFail(Session::get('UserLoggedIn')->id)->halls->bookings;

        if($data->count()){

            foreach ($data as $key) {

                if($key->is_confirmed == 1){
                    $events[] = Calendar::event(

                        'Booked',

                        true,

                        new \DateTime(new Carbon($key->date)),

                        new \DateTime(new Carbon($key->date)),

                        ['id' => $key->id],

                        ['url' => Route('user.booking.show',$key->id)]

                    );
                }

            }

        }

        $calendar = Calendar::addEvents($events);

        $user = User::findOrFail(Session::get('UserLoggedIn')->id);
        return view('user.dashboard.index',compact('user','calendar'));
    })->name('user.dashboard');


    Route::get('user/viewProfile',function(){
        $user = User::findOrFail(Session::get('UserLoggedIn')->id);
        return view('user.dashboard.viewProfile',compact('user'));
    })->name('user.viewProfile');


    Route::get('/user/editProfile/{id}/edit',['uses'=>'UserController@showEditProfile','as'=>'user.editProfile']);
    Route::patch('user/editProfile/{id}', ['uses'=>'UserController@storeEditProfile','as'=>'user.editProfile.update']);

    Route::get('/user/editPasssword/{id}/edit',['uses'=>'UserController@showEditPassword','as'=>'user.editPassword']);
    Route::patch('user/editPasssword/{id}', ['uses'=>'UserController@storeEditPassword','as'=>'user.editPassword.update']);

    Route::post('user/viewProfile/', ['uses'=>'UserController@storePhotos','as'=>'user.viewProfile']);

    Route::delete('user/viewProfile/{id}', ['uses'=>'UserController@deletePhotos','as'=>'user.viewProfile.deletePhotos']);

    Route::post('ajax-edit-user', ['as'=>'user.ajax-edit-user','uses'=>'UserController@editAjax']);

    Route::resource('user/booking','UserBookingController',['as'=>'user']);

    Route::get('user/logout',['uses'=>'LoginController@userLogout','as'=>'user.logout']);

    Route::get('user/pendingBooking',['uses'=>'UserBookingController@showPending','as'=>'user.pending']);

    Route::get('user/confirmBooking{id}',['uses'=>'UserBookingController@confirmBooing','as'=>'user.confirm']);

});





Route::group(['middleware'=>'ChkAdmin'],function(){

    Route::get('admin/dashboard',function(){
        $admin = Admin::findOrFail(Session::get('AdminLoggedIn')->id);
        return view('admin.dashboard.index',compact('admin'));
    })->name('admin.dashboard');

    Route::get('admin/users/deactivated',function(){
        $users = User::where('is_active',0)->get();
        return view('admin.users.deactivated',compact('users'));
    })->name('admin.deactivated');

    Route::resource('admin/admins','AdminController',['as'=>'admin']);

    Route::resource('admin/cities','AdminCityController',['as'=>'admin']);

    Route::resource('admin/areas','AdminAreaController',['as'=>'admin']);

    Route::resource('admin/users','AdminUserController',['as'=>'admin']);

    Route::get('/admin/changePassword/{id}/index',['uses'=>'AdminController@showEditPassword','as'=>'admin.changePassword']);
    Route::patch('/admin/changePassword/{id}/', ['uses'=>'AdminController@storeEditPassword','as'=>'admin.changePassword.update']);

    Route::post('select-ajax', ['as'=>'select-ajax','uses'=>'AdminUserController@selectAjax']);

    Route::post('ajax-edit-select', ['as'=>'ajax-edit-select','uses'=>'AdminUserController@editAjax']);

    Route::get('admin/logout',['uses'=>'LoginController@adminLogout','as'=>'admin.logout']);

    Route::get('/admin/userStatus/{id}/{val}', ['uses'=>'AdminUserController@userStatus','as'=>'admin.userStatus']);

    Route::get('/admin/deactive/{id}/', ['uses'=>'AdminUserController@deactive','as'=>'admin.deactive']);


});

//Payments

Route::get('/payment',function (){
    return view('payments.payment');
});

Route::get('/paid', 'PaymentController@payment_info');


Route::get('/payments/bookingpayment',function() {
    return view('payments.bookingpayment');
});

Route::get('/bookingpayment',function() {
    return view('payments.bookingpayment');
});


Route::get('/booked', 'PaymentController@book_payment');
?>