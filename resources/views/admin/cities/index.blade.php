@extends('layout.admin');


@section('title')
    View Cities
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">View Cities</h2>
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
                <h2><a class="col-lg-3 btn btn-success" href="{{Route('admin.cities.create')}}">Create City</a></h2>
                <br><br>
                <table class="table">
                    <thead>
                        <tr  class="col-lg-1">
                            <td><h3>Name</h3></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr class="col-lg-7">
                                <td class="col-lg-1">{{$city->name}}</td>
                                <td class="col-lg-1"><a class="btn btn-sm btn-primary" href="{{Route('admin.cities.edit',$city->id)}}">Edit</a></td>
                                <td class="col-lg-1">
                                    {!! Form::open(['method'=>'DELETE','action'=>['AdminCityController@destroy',$city->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::submit('Delete' , ['class'=>'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
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
    </div>

@endsection