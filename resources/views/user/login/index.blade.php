<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>

<body>
<div class="login">
    <h1>Login</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'LoginController@storeUser']) !!}

    {!! Form::text('username', null, ['class'=>'form-control','placeholder'=>'Username','required'=>'required']) !!}
    <br>
    {!! Form::password('password', null, ['class'=>'form-control','placeholder'=>'Password','required'=>'required']) !!}
    <br><br>
    {!! Form::submit('Login', ['class'=>'btn-warning btn-large']) !!}

    {!! Form::close() !!}
    <br>
    <a href="{{Route('user.signup')}}" class="btn btn-warning col-lg-12">SignUp</a>

    <br><br><br>
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

</body>
</html>
