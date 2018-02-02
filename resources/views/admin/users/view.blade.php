@extends('layout.admin');


@section('title')
    User Detail
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">User Detail</h2>
                </div>

            </div>
            <!-- /. ROW  -->
            <hr />

            @if(Session::has('updated'))
                <p class="alert bg-success ">{{Session('updated')}}</p>
            @endif

            <h2><a class="btn btn-primary" href="{{Route('admin.users.edit',$user->id)}}">Edit User</a></h2>

            <div>
                <table>
                    <tr>
                        <td class="col-lg-2"><h3>Name:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->fname}} {{$user->lname}}</h4></td>
                    </tr>


                    <tr>
                        <td class="col-lg-1"><h3>Username:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->username}}</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Email:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->email}}</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Contact No:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->contact}} / {{$user->halls->contact}}</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Banquet Name:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->halls->name}}</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Status:</h3></td>
                        @if($user->is_active == 0)
                            <td class="col-lg-3"><h4>Deactive</h4></td>
                        @else
                            <td class="col-lg-3"><h4>Active</h4></td>
                        @endif
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Capacity:</h3></td>
                        <td class="col-lg-3"><h4>{{number_format($user->halls->capacity,0)}} People</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Price:</h3></td>
                        <td class="col-lg-3"><h4>{{number_format($user->halls->min_price,0)}} - {{number_format($user->halls->max_price,0)}} Rupees</h4></td>
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Area:</h3></td>
                        @if($user->halls->area  != null)
                            <td class="col-lg-1">{{$user->halls->area->name}}</td>
                        @else
                            <td class="col-lg-1">NA</td>
                        @endif

                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>City:</h3></td>
                        @if($user->halls->area != null)
                            <td class="col-lg-1">{{$user->halls->area->city->name}}</td>
                        @else
                            <td class="col-lg-1">NA</td>
                        @endif
                    </tr>

                    <tr>
                        <td class="col-lg-1"><h3>Description:</h3></td>
                        <td class="col-lg-3"><h4>{{$user->halls->desc}}</h4></td>
                    </tr>

                </table>

            </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>

@endsection