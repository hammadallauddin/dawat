<?php

namespace App\Http\Controllers;

use App\Admin;
use App\City;
use App\Http\Requests\CreateUser;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Keygen\Keygen;

class LoginController extends Controller
{
    public function user(){
        return view('user.login.index');
    }

    public function storeUser(LoginRequest $request){
        $username = $request->username;
        $password = $request->password;
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email',$request->username)->get()->first();
            if($user!=null){
                if($user->password == $password){
                    Session::put('UserLoggedIn', $user);
                    return redirect()->intended('/user/dashboard');
                }
                else{
                    Session::put('UserLoggedIn', null);
                    return redirect('user/login')->withErrors(['PasswordNotMatch'=>'Email and Password not match']);
                }
            }
            else{
                Session::put('UserLoggedIn', null);
                return redirect('user/login')->withErrors(['NoUser'=>'Invalid Email']);
            }
        }
        else {
            $user = User::where('username',$request->username)->get()->first();
            if($user!=null){
                if($user->password == $password){
                    Session::put('UserLoggedIn', $user);
                    return redirect()->intended('/user/dashboard');
                }
                else{
                    Session::put('UserLoggedIn', null);
                    return redirect('user/login')->withErrors(['PasswordNotMatch'=>'Username and Password not match']);
                }
            }
            else{
                Session::put('UserLoggedIn', null);
                return redirect('user/login')->withErrors(['NoEmail'=>'Invalid Username']);
            }
        }
    }


    public function admin(){
        return view('admin.login.index');
    }

    public function storeAdmin(LoginRequest $request){
        $username = $request->username;
        $password = $request->password;

        $admin = Admin::where('username',$username)->get()->first();

        if($admin!=null){
            if($admin->password == $password){
                Session::put('AdminLoggedIn', $admin);
                return redirect()->intended('/admin/dashboard/');
            }
            else{
                Session::put('AdminLoggedIn', null);
                return redirect('admin/login')->withErrors(['PasswordNotMatch'=>'username and Password not match']);
            }
        }
        else{
            Session::put('AdminLoggedIn', null);
            return redirect('admin/login')->withErrors(['NoUser'=>'Invalid Username']);
        }
    }

    public function signup(){
        $cities = City::pluck('name','id')->all();
        return view('user.login.signup',compact('cities'));
    }

    public function createUser(CreateUser $request){

        $key = Keygen::numeric(8)->generate();

        if($request->password == $request->confirm_password)
        {
            if(($request->minimum_rate >= 10000)&&($request->minimum_rate < $request->maximum_rate)){
                if($request->maximum_rate <= 2000000){
                    if($request->capacity >= 100 && $request->capacity <= 1000){
                        $user = new User;
                        $user
                            ->create(['fname'=>$request->first_name,'lname'=>$request->last_name,'username'=>$request->username,'password'=>$request->password,'email'=>$request->email,'contact'=>$request->user_phone,'is_active'=>0,'is_verified'=>0,'verify_mail'=>$key,'fees'=>$request->fees,'expire'=>$request->expire,'paypal_email'=>$request->paypal_email])
                            ->halls()
                            ->create(['name'=>$request->banquet_name,'area_id'=>$request->area,'capacity'=>$request->capacity,'min_price'=>$request->minimum_rate,'max_price'=>$request->maximum_rate,'contact'=>$request->banquet_phone,'desc'=>$request->description]);

                            $data = [
                                'title' => 'User Created',
                                'content' => 'Dear ' .$request->fname.' '.$request->lname.' your account has been created. Verify you email using this '.$key.' code',
                            ];

                            Mail::send('consumer.mail',$data,function ($message) use ($request) {
                                $message->to($request->email,$request->fname.' '.$request->lname)->subject('User Created');
                            });

                            Session::flash('created','User Has been created. Waiting for Activation');
                            return redirect('/user/login');
                        }
                        else{
                            return redirect('/user/signup')->withErrors(['invalid_capacity'=>'capacity is invalid']);
                        }
                    }
                    else{
                        return redirect('/user/signup')->withErrors(['invalid_maximum_rate'=>'Maximum rate is invalid']);
                    }
                }
                else{
                    return redirect('//user/signup')->withErrors(['invalid_minimum_rate'=>'Minimum rate is invalid']);
                }
        }
        else{
            return redirect('/user/signup')->withErrors(['password_not_match'=>'Password not matched']);
        }
    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $areas = DB::table('areas')->where('city_id',$request->city)->get();
            $data = view('/user/login/ajax-select',compact('areas'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function verifyUser(Request $request){
        $this->validate($request, [
            'verfiy' => 'numeric'
        ]);

        if(Session::get('UserLoggedIn')->verify_mail == $request->verfiy){
            Session::get('UserLoggedIn')->update(['is_verified'=>1]);
            return redirect('user/dashboard');
        }
        else{
            return redirect('user/verify')->withErrors(['invalid_code'=>'Invalid verification Code']);
        }
    }


    public function adminLogout(){
        Session::put('AdminLoggedIn', null);
        return redirect('admin/login');
    }

    public function userLogout(){
        Session::put('UserLoggedIn', null);
        return redirect('user/login');
    }

}
