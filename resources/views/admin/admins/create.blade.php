@extends('layout.admin');


@section('title')
    Create Admin
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Create Admin</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            {!! Form::open(['method'=>'POST', 'action'=>'AdminController@store']) !!}

            <br>
            {!! Form::label('fname', 'First Name:') !!}
            {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
            <br>
            {!! Form::label('lname', 'Last Name:') !!}
            {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
            <br>
            {!! Form::label('username', 'Username:') !!}
            {!! Form::text('username', null, ['class'=>'form-control']) !!}
            <br>
            {!! Form::label('password', 'Password:') !!}
            {{ Form::password('password',  ['class' => 'form-control']) }}
            <br>
            {!! Form::label('confirm_password', 'Confirm Password:') !!}
            {{ Form::password('confirm_password',  [ 'class' => 'form-control']) }}
            <br>
            {!! Form::submit('Create Admin', ['class'=>'btn btn-warning']) !!}

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