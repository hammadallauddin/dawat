@extends('layout.admin');


@section('title')
    Edit Area
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Edit Area</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div>

                {!! Form::model($area, ['method'=>'PATCH', 'action'=>['AdminAreaController@update', $area->id]]) !!}
                <br>
                {!! Form::label('area_name', 'Area Name:') !!}
                {!! Form::text('area_name', $area->name, ['class'=>'form-control']) !!}
                <br>
                {!! Form::label('city', 'City:') !!}
                {!! Form::select('city',[0 => '-Select-'] + $city, $area->city->name, ['class'=>'form-control']) !!}
                <br>
                {!! Form::submit('Edit Area', ['class'=>'btn btn-warning']) !!}

                {!! Form::close() !!}

            </div>
            <br>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <!-- /. PAGE INNER  -->
    </div>

@endsection