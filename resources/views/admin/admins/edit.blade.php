@extends('layout.admin');


@section('title')
    Edit Admin
@endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Edit Admin</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div>

                {!! Form::model($admin, ['method'=>'PATCH', 'action'=>['AdminController@update', $admin->id]]) !!}
                <br>
                {!! Form::label('first_name', 'First Name:') !!}
                {!! Form::text('first_name', $admin->fname, ['class'=>'form-control']) !!}
                <br>
                {!! Form::label('last_name', 'Last Name:') !!}
                {!! Form::text('last_name', $admin->lname, ['class'=>'form-control']) !!}
                <br>
                {!! Form::label('username', 'Username:') !!}
                {!! Form::text('username', $admin->username, ['class'=>'form-control']) !!}
                <br>
                {!! Form::submit('Edit Admin', ['class'=>'btn btn-warning']) !!}

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
    </div>

@endsection