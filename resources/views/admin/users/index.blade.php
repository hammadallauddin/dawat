@extends('layout.admin');


@section('title')
    View Users
@endsection


@section('content')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">View Users</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            @if(Session::has('deleted'))
                <p class="alert bg-danger ">{{Session('deleted')}}</p>
            @elseif(Session::has('created'))
                <p class="alert bg-success ">{{Session('created')}}</p>
            @elseif(Session::has('updated'))
                <p class="alert bg-success ">{{Session('updated')}}</p>
            @endif

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <td><h3>Banquet Name</h3></td>
                            <td><h3>Owner</h3></td>
                            <td><h3>Area</h3></td>
                            <td><h3>City</h3></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users != null)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->halls->name}}</td>
                                    <td>{{$user->fname}} {{$user->lname}}</td>

                                    @if($user->halls->area  != null)
                                        <td>{{$user->halls->area->name}}</td>
                                    @else
                                        <td>NA</td>
                                    @endif

                                    @if($user->halls->area != null)
                                        <td>{{$user->halls->area->city->name}}</td>
                                    @else
                                        <td>NA</td>
                                    @endif

                                    @if($user->is_active == 0)
                                        <td><a href="{{ Route( 'admin.userStatus' ,['id'=>$user->id ,'val'=>1])}}" class="btn btn-sm btn-success">Activate</a></td>
                                    @else
                                        <td><a href="{{Route( 'admin.userStatus', ['id'=>$user->id ,'val'=>0])}}" class="btn btn-sm btn-danger">Deactive</a></td>
                                    @endif

                                    <td><a class="btn btn-sm btn-primary" href="{{Route('admin.users.show',$user->id)}}">Detail</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </tbody>
                </table>
            </div>


        </div>
        <!-- /. PAGE INNER  -->
    </div>
@endsection