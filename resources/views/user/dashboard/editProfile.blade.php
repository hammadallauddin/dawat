@extends('layout.user')

@section('title')
    Edit Profile
@endsection


@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <h2 style="color: #f0ad4e">Edit Profile</h2>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />

    @if(Session::has('deleted'))
        <p class="alert bg-success ">{{Session('deleted')}}</p>
    @endif


    <div class="col-sm-9">
        {!! Form::model($user,['method'=>'PATCH', 'action'=>['UserController@storeEditProfile',$user->id], 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('first_name', 'First Name:') !!}
            {!! Form::text('first_name', $user->fname, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('last_name', 'Last Name:') !!}
            {!! Form::text('last_name', $user->lname, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('username', 'Username:') !!}
            {!! Form::text('username', $user->username, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email',  $user->email, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('user_phone', 'User\'s Phone:') !!}
            {!! Form::text('user_phone', $user->contact, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('banquet_phone', 'Banquets\'s Phone:') !!}
            {!! Form::text('banquet_phone', $user->halls->contact, ['class'=>'form-control']) !!}
        </div>

        <div>
            {!! Form::label('city', 'City:') !!}
            <select  name="city" id="city" class="form-control">
                <option default value="">-Select-</option>
                @foreach($city as $cities)
                    <option default value="{{$cities->id}}">{{$cities->name}}</option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            {!! Form::label('area', 'Area:') !!}
            {!! Form::select('area',[''=>'-Select-'] , null, ['class'=>'form-control']) !!}
        </div>
        <br>

        <div class="form-group">
            {!! Form::label('banquet_name', 'Banquet Name:') !!}
            {!! Form::text('banquet_name', $user->halls->name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('capacity', 'Capacity:') !!}
            {!! Form::text('capacity', $user->halls->capacity, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('minimum_rate', 'Minimum Rate:') !!}
            {!! Form::text('minimum_rate', $user->halls->min_price, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('maximum_rate', 'Maximum Rate:') !!}
            {!! Form::text('maximum_rate', $user->halls->max_price, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', $user->halls->desc, ['class'=>'form-control span6','rows'=>'5']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class'=>'btn btn-warning col-sm-3']) !!}
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

    <script type="text/javascript">
        $("select[name='city']").change(function(){
            var city = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('user.ajax-edit-user') ?>",
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