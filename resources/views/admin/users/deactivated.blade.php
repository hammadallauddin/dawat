@extends('layout.admin');


@section('title')
    Deactivated Users
@endsection


@section('content')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Deactivated Users</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            @if(Session::has('activated'))
                <p class="alert bg-success ">{{Session('activated')}}</p>
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

                                <td><a href="{{ Route( 'admin.deactive' ,['id'=>$user->id ])}}" class="btn btn-sm btn-success">Activate</a></td>

                                <td><a class="btn btn-sm btn-primary" href="{{Route('admin.users.show',$user->id)}}">detail</a></td>
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