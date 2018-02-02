<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Http\Requests\CreateArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.areas.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::pluck('name', 'id')->all();
        return view('admin.areas.create',compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArea $request)
    {
        $area = $request->area_name;
        $city = $request->city;
        if($city == 0){
            return redirect('admin/areas/create')->withErrors(['select_city'=>'City field is not selected']);
        }
        else{
            Area::create(['name'=>$area,'city_id'=>$city]);
            Session::flash('created','Area has been created');
            return redirect('admin/areas');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find($id);
        $city = City::pluck('name', 'id')->all();
        return view('admin.areas.edit',compact('area','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateArea $request, $id)
    {
        $name = $request->area_name;
        $city = $request->city;
        if($city == 0){
            return redirect('admin/areas/'.$id.'/edit')->withErrors(['select_city'=>'City field is not selected']);
        }
        else{
            $area_id = Area::find($id);
            $area_id->update(['name'=>$name,'city_id'=>$city]);
            Session::flash('updated','Area has been updated');
            return redirect('admin/areas');
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
        $area = Area::findOrFail($id);
        $area->delete();
        Session::flash('deleted','Area Has been Deleted');
        return redirect('admin/areas');
    }
}
