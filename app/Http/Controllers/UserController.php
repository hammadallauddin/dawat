<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\CreateImage;
use App\Http\Requests\EditUser;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showEditProfile($id){
        $city = City::all();
        $area = Area::all();
        $user = User::findOrFail($id);
        return view('user.dashboard.editProfile',compact('user','area','city'));
    }

    public function storeEditProfile(EditUser $request,$id){
        $user = User::findOrFail($id);
        $user->update(['fname'=>$request->first_name,'lname'=>$request->last_name,'username'=>$request->username,'email'=>$request->email,'contact'=>$request->user_phone]);
        $user->halls()->update(['name'=>$request->banquet_name,'area_id'=>$request->area,'contact'=>$request->banquet_phone,'capacity'=>$request->capacity,'min_price'=>$request->minimum_rate,'max_price'=>$request->maximum_rate,'desc'=>$request->description]);
        Session::flash('updated','Profile has been Updated');
        return redirect('/user/viewProfile');
    }

    public function showEditPassword($id){
        $user = User::findOrFail($id);
        return view('user.dashboard.changePassword',compact('user'));
    }


    public function storeEditPassword(ChangePassword $request,$id){
        $user = User::find($id);
        if($user->password != $request->old_password){
            return redirect('user/editPasssword/'.$id.'/edit')->withErrors(['no_password'=>'Incorrect old Password']);
        }
        else{
            if($request->new_password != $request->confirm_password){
                return redirect('user/editPasssword/'.$id.'/edit')->withErrors(['not_matched'=>'Password not matched']);
            }
            else{
                $user->update(['password'=>$request->new_password]);
                Session::flash('Password_changed','Password Has been Changed');
                return redirect('user/editPasssword/'.$id.'/edit');
            }
        }
    }


    public function storePhotos(CreateImage $request){
        $user = User::findOrFail(Session::get('UserLoggedIn')->id);

        $file = $request->file('photo_id');

        $destinationPath = public_path(). '/images/halls';
        $filename = time() . $file->getClientOriginalName();

        $file->move($destinationPath, $filename);


        $user->halls->photos()->create(['file'=>$filename]);
        Session::flash('created','Photo has been uploaded');
        return redirect('/user/viewProfile');
    }

    public function deletePhotos($id){
        $user = User::findOrFail(Session::get('UserLoggedIn')->id);
        $photo = $user->halls->photos->find($id);
        unlink(public_path().'\images\halls\\'.$photo->file);
        $photo->delete();
        Session::flash('deleted','Photo has been deleted');
        return redirect('/user/viewProfile/');
    }

    public function editAjax(Request $request)
    {
        if($request->ajax()){
            $areas = DB::table('areas')->where('city_id',$request->city)->get();
            $data = view('user/dashboard/ajax-edit-select',compact('areas'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function pendingBooking(){
        return view('user.pending');
    }
}
