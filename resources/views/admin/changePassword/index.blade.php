@extends('layout.admin');


@section('title')
    Change Password
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Change Password</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            @if(Session::has('Password_changed'))
                <p class="alert bg-success">{{Session('Password_changed')}}</p>
            @endif
            <div>
                <br>
                {!! Form::model($admin, ['method'=>'PATCH', 'action'=>['AdminController@storeEditPassword', $admin->id]]) !!}
                <br>
                {!! Form::label('OldPassword', 'Old Password:') !!}
                <br>
                {!! Form::password('old_password', ['class'=>'form-control']) !!}
                <br><br>
                {!! Form::label('NewPassword', 'New Password:') !!}
                <br>
                {!! Form::password('new_password', ['class'=>'form-control']) !!}
                <br><br>
                {!! Form::label('ConfPass', 'Confirm Password:') !!}
                <br>
                {!! Form::password('confirm_password', ['class'=>'form-control']) !!}
                <br><br>
                {!! Form::submit('Change Password', ['class'=>'btn btn-warning']) !!}
                {!! Form::close() !!}

            </div>
            <br><br>
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
@endsection
