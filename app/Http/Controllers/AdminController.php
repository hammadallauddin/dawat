<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\CreateAdmin;
use App\Http\Requests\EditAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdmin $request)
    {
        if($request->password == $request->confirm_password){
            $input['fname'] = $request->first_name;
            $input['lname'] = $request->last_name;
            $input['username'] = $request->username;
            $input['password'] = $request->password;
            Admin::create($input);
            Session::flash('created','Admin has been created');
            return redirect('admin/admins');
        }
        else{
            return redirect('admin/admins/create')->withErrors(['not_match'=>'Password not matched']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAdmin $request, $id)
    {
        $fname = $request->first_name;
        $lnamme = $request->last_name;
        $username = $request->username;
        $admin = Admin::find($id);
        $admin->update(['fname'=>$fname,'lname'=>$lnamme,'username'=>$username]);
        Session::flash('updated','Admin has been updated');
        return redirect('admin/admins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        Session::flash('deleted','Admin Has been Deleted');
        return redirect('admin/admins');
    }


    public function showEditPassword($id){
        $admin = Admin::findOrFail($id);
        return view('admin.changePassword.index',compact('admin'));
    }


    public function storeEditPassword(ChangePassword $request,$id){
        $admin = Admin::find($id);
        if($admin->password != $request->old_password){
            return redirect('admin/changePassword/'.$id.'/index')->withErrors(['no_password'=>'Incorrect old Password']);
        }
        else{
            if($request->new_password != $request->confirm_password){
                return redirect('admin/changePassword/'.$id.'/index')->withErrors(['not_matched'=>'Password not matched']);
            }
            else{
                $admin->update(['password'=>$request->new_password]);
                Session::flash('Password_changed','Password Has been Changed');
                return redirect('admin/changePassword/'.$id.'/index');
            }
        }
    }

}
