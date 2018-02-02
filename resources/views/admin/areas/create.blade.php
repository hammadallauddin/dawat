@extends('layout.admin');


@section('title')
    Create Area
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Create Area</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            {!! Form::open(['method'=>'POST', 'action'=>'AdminAreaController@store']) !!}

            <br>
            {!! Form::label('area_name', 'Area Name:') !!}
            {!! Form::text('area_name', null, ['class'=>'form-control']) !!}
            <br>
            {!! Form::label('city', 'City:') !!}
            {!! Form::select('city', [0=>'-Select-']+$city, null, ['class'=>'form-control']) !!}
            <br>
            {!! Form::submit('Create Area', ['class'=>'btn btn-warning']) !!}

            {!! Form::close() !!}
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