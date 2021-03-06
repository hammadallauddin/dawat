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

    {!! Form::open(['method'=>'POST', 'action'=>'LoginController@storeAdmin']) !!}

    {!! Form::text('username', null, ['class'=>'form-control','placeholder'=>'Username','required'=>'required']) !!}
    <br>
    {!! Form::password('password',  ['class'=>'form-control','placeholder'=>'Password','required'=>'required']) !!}
    <br><br>
    {!! Form::submit('Login', ['class'=>'btn-warning btn-large']) !!}

    {!! Form::close() !!}
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
