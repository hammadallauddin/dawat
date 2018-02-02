@extends('layout.admin');


@section('title')
    View Areas
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">View Areas</h2>
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

                <h2><a class="col-lg-3 btn btn-success" href="{{Route('admin.areas.create')}}">Create Area</a></h2>
                <br>    <br>
                <table class="table">
                    <thead>
                        <tr class="col-lg-8">
                            <td class="col-lg-4"><h3>Name</h3></td>
                            <td class="col-lg-4"><h3>City</h3></td>
                            <td class="col-lg-4"></td>
                            <td class="col-lg-4"></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cities as $city)
                            @foreach($city->areas as $area)
                                <tr class="col-lg-8">
                                    <td class="col-lg-4">{{$area->name}}</td>
                                    <td class="col-lg-4">{{$city->name}}</td>
                                    <td class="col-lg-4"><a class="btn btn btn-sm btn-primary" href="{{Route('admin.areas.edit',$area->id)}}">Edit</a></td>
                                    <td class="col-lg-4">
                                        {!! Form::open(['method'=>'DELETE','action'=>['AdminAreaController@destroy',$area->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                                        {!! Form::submit('Delete' , ['class'=>'btn btn-sm btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
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
        <!-- /. PAGE INNER  -->
    </div>

@endsection