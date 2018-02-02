@extends('layout.admin');


@section('title')
    View Admins
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">View Admins</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            @if(Session::has('deleted'))
                <p class="bg-danger ">{{Session('deleted')}}</p>
            @elseif(Session::has('created'))
                <p class="bg-success ">{{Session('created')}}</p>
            @elseif(Session::has('updated'))
                <p class="bg-success ">{{Session('updated')}}</p>
            @endif

            <div>
                <h2><a class="col-lg-3 btn btn-success" href="{{Route('admin.admins.create')}}">Create Admin</a></h2>
                <br><br>
               <div class="container-fluid">
                   <table class="table table-borderless" >
                       <tbody>
                            <thead>
                               <tr>
                                   <td><h3>Name</h3></td>
                                   <td><h3>Userame</h3></td>
                               </tr>
                            </thead>
                           @foreach($admins as $admin)
                               <tr>
                                   @if($admin->id == Session::get('AdminLoggedIn')->id)
                                       <td>{{$admin->fname}} {{$admin->lname}}</td>
                                       <td>{{$admin->username}}</td>
                                       <td><a class="btn btn-sm btn-primary" href="{{Route('admin.admins.edit',$admin->id)}}">Edit</a></td>
                                   @else
                                       <td>{{$admin->fname}} {{$admin->lname}}</td>
                                       <td>{{$admin->username}}</td>
                                       <td><a class="btn btn-sm btn-primary" href="{{Route('admin.admins.edit',$admin->id)}}">Edit</a></td>
                                       <td>
                                           {!! Form::open(['method'=>'DELETE','action'=>['AdminController@destroy',$admin->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                                           {!! Form::submit('Delete' , ['class'=>'btn btn-sm btn-danger']) !!}
                                           {!! Form::close() !!}
                                       </td>
                                   @endif
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
            </div>
            <script>

                function ConfirmDelete()
                {
                    var x = confirm("Are you sure you want to delete?");
                    if (x)
                        return true;
                    else
                        return false;
                }

            </script>

        </div>

@endsection