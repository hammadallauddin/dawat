<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Http\Requests\CreateUser;
use App\Http\Requests\EditUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Keygen\Keygen;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('name', 'id')->all();
        $cities = City::pluck('name', 'id')->all();
        return view('admin.users.create',compact('areas','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {

        $key = Keygen::numeric(8)->generate();

        if($request->password == $request->confirm_password)
        {
            if($request->is_active == null){
                $active = 0;
            }
            else{
                $active = 1;
            }
            if(($request->minimum_rate >= 10000)&&($request->minimum_rate < $request->maximum_rate)){
                if($request->maximum_rate <= 2000000){
                    if($request->capacity >= 100 && $request->capacity <= 1000){
                        $user = new User;
                        $user
                            ->create(['fname'=>$request->first_name,'lname'=>$request->last_name,'username'=>$request->username,'password'=>$request->password,'email'=>$request->email,'contact'=>$request->user_phone,'is_active'=>$active,'is_verified'=>0,'verify_mail'=>$key])
                            ->halls()
                            ->create(['name'=>$request->banquet_name,'area_id'=>$request->area,'capacity'=>$request->capacity,'min_price'=>$request->minimum_rate,'max_price'=>$request->maximum_rate,'contact'=>$request->banquet_phone,'desc'=>$request->description]);

                        $data = [
                            'title' => 'User Created',
                            'content' => 'Dear ' .$request->fname.' '.$request->lname.' your account has been created. Verify you email using this '.$key.' code',
                        ];

                        Mail::send('consumer.mail',$data,function ($message) use ($request) {
                            $message->to($request->email,$request->fname.' '.$request->lname)->subject('User Created');
                        });

                        Session::flash('created','User Has been Created');
                        return redirect('/admin/users');
                    }
                    else{
                        return redirect('/admin/users/create')->withErrors(['invalid_capacity'=>'capacity is invalid']);
                    }
                }
                else{
                    return redirect('/admin/users/create')->withErrors(['invalid_maximum_rate'=>'Maximum rate is invalid']);
                }
            }
            else{
                return redirect('/admin/users/create')->withErrors(['invalid_minimum_rate'=>'Minimum rate is invalid']);
            }
        }
        else{
            return redirect('/admin/users/create')->withErrors(['password_not_match'=>'Password not matched']);
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
        $user = User::findOrFail($id);
        return view('admin.users.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        Session::put('user',$user);
        $areas = Area::all();
        $city = City::all();
        return view('admin.users.edit',compact('user','areas','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, $id)
    {
        if($request->is_active == null){
            $active = 0;
        }
        else{
            $active = 1;
        }


        if($request->city == 0){
            return redirect('/admin/users/'.$id.'/edit')->withErrors(['city'=>'City not Selected']);
        }
        elseif ($request->area == 0){
            return redirect('/admin/users/'.$id.'/edit')->withErrors(['area'=>'Area not Selected']);
        }
        else{
            if($request->minimum_rate>10000 && $request->minimum_rate<$request->maximum_rate){
                if($request->maximum_rate<1000000){
                    if($request->capacity > 100 && $request->capacity < 2000){
                        $user = User::findOrFail($id);
                        $user->update(['fname'=>$request->first_name,'lname'=>$request->last_name,'username'=>$request->username,'email'=>$request->email,'contact'=>$request->user_phone,'is_active'=>$active]);
                        $user->halls()->update(['name'=>$request->banquet_name,'area_id'=>$request->area,'capacity'=>$request->capacity,'min_price'=>$request->minimum_rate,'max_price'=>$request->maximum_rate,'contact'=>$request->banquet_phone,'desc'=>$request->description]);
                        Session::flash('updated','User Has been Updated');
                        return redirect('/admin/users/'.$id);
                    }
                    else{
                        return redirect('/admin/users/'.$id.'/edit')->withErrors(['invalid_capacity'=>'capacity is invalid']);
                    }
                }
                else{
                    return redirect('/admin/users/'.$id.'/edit')->withErrors(['invalid_maximum_rate'=>'Maximum rate is invalid']);
                }
            }
            else{
                return redirect('/admin/users/'.$id.'/edit')->withErrors(['invalid_minimum_rate'=>'Minimum rate is invalid']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('deleted','User Has been Deleted');
        return redirect('/admin/users');
    }


    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $areas = DB::table('areas')->where('city_id',$request->city)->get();
            $data = view('admin/users/ajax-select',compact('areas'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function editAjax(Request $request)
    {
        if($request->ajax()){
            $areas = DB::table('areas')->where('city_id',$request->city)->get();
            $data = view('admin/users/ajax-edit-select',compact('areas'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function userStatus($id,$val)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active'=>$val]);
        return redirect('/admin/users');
    }

    public function deactive($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active'=>1]);
        Session::flash('activated','User has been activated');
        $data = [
            'title' => 'Account Verified',
            'content' => 'Dear ' .$user->fname.' '.$user->lname.' your account has been activated',
        ];

        Mail::send('admin.users.mail',$data,function ($message) use ($user) {
            $message->to($user->email,'Hammad')->subject('Account Verified');
        });
        return redirect('/admin/users/deactivated');
    }

}
