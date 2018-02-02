@extends('layout.admin');


@section('title')
    Create User
@endsection


@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Create User</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            {!! Form::open(['method'=>'POST', 'action'=>'AdminUserController@store']) !!}

            <div class="form-group">
                {!! Form::label('first_name', 'First Name:') !!}
                {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('last_name', 'Last Name:') !!}
                {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('username', 'Username:') !!}
                {!! Form::text('username', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email',  null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('user_phone', 'User\'s Phone:') !!}
                {!! Form::text('user_phone', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('confirm_password', 'Confirm Password:') !!}
                {!! Form::password('confirm_password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('banquet_name', 'Banquet Name:') !!}
                {!! Form::text('banquet_name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Is Active:') !!}<br>
                {!! Form::checkbox('is_active', 1, null, ['class' => 'field']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('banquet_phone', 'Banquets\'s Phone:') !!}
                {!! Form::text('banquet_phone', null, ['class'=>'form-control']) !!}
            </div>

            <div>
                {!! Form::label('city', 'City:') !!}
                {!! Form::select('city',[0 => '-Select-']+$cities , null, ['class'=>'form-control']) !!}
            </div>
            <br>
            <div>
                {!! Form::label('area', 'Area:') !!}
                {!! Form::select('area',[''=>'-Select-'] , null, ['class'=>'form-control']) !!}
            </div>
            <br>


            <div class="form-group">
                {!! Form::label('capacity', 'Capacity:') !!}
                {!! Form::text('capacity', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('minimum_rate', 'Minimum Rate:') !!}
                {!! Form::text('minimum_rate', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('maximum_rate', 'Maximum Rate:') !!}
                {!! Form::text('maximum_rate', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', null, ['class'=>'form-control span6','rows'=>'5']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create User', ['class'=>'btn btn-warning col-sm-3']) !!}
            </div>
            {!! Form::close() !!}
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
        <!-- /. PAGE INNER  -->
    </div>

    <script type="text/javascript">
        $("select[name='city']").change(function(){
            var city = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-ajax') ?>",
                method: 'POST',
                data: {city:city, _token:token},
                success: function(data) {
                    $("select[name='area']").html('');
                    $("select[name='area']").html(data.options);
                }
            });
        });
    </script>

@endsection