<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>SignUp</title>
    <link href="{{asset('css/adminSignUp.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>

<body>
<br>
    <div class="alert alert-warning">
        <p align="center">Remember: Your Account would not be active until you pay the fees i.e. PKR 5000 per annum</p>
    </div>
<div class="login col-lg-12">
    <h1>SignUp</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'LoginController@createUser']) !!}

    <div class="form-group col-lg-4">
        {!! Form::label('first_name', 'First Name:') !!}
        {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('username', 'Username:') !!}
        {!! Form::text('username', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email',  null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('user_phone', "User's Phone:") !!}
        {!! Form::number('user_phone', null, ['class'=>'form-control']) !!}
    </div>



    <div class="form-group col-lg-4">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('confirm_password', 'Confirm Password:') !!}
        {!! Form::password('confirm_password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('banquet_name', 'Banquet Name:') !!}
        {!! Form::text('banquet_name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('banquet_phone', 'Banquets\'s Phone:') !!}
        {!! Form::number('banquet_phone', null, ['class'=>'form-control']) !!}
    </div>

    <div class="col-lg-4">
        {!! Form::label('city', 'City:') !!}
        {!! Form::select('city',[0 => '-Select-']+$cities , null, ['class'=>'form-control']) !!}
    </div>

    <div class="col-lg-4">
        {!! Form::label('area', 'Area:') !!}
        {!! Form::select('area',[''=>'-Select-'] , null, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group col-lg-4">
        {!! Form::label('capacity', 'Capacity:') !!}
        {!! Form::number('capacity', null, ['min'=>100,'max'=>1000], ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('minimum_rate', 'Minimum Rate:') !!}
        {!! Form::number('minimum_rate', null, ['min'=>10000,'max'=>2000000], ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('maximum_rate', 'Maximum Rate:') !!}
        {!! Form::number('maximum_rate', null, ['min'=>10000,'max'=>2000000], ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4">
        {!! Form::label('paypal_email', "Paypal Email Address:") !!}
        {!! Form::text('paypal_email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-lg-4 col-sm-offset-4">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::text('description', null, ['class'=>'form-control span6','rows'=>'5']) !!}
    </div>



        {!! Form::hidden('fees', 5000, ['class'=>'form-control span6','rows'=>'5']) !!}

        {!! Form::hidden('expire', Carbon\Carbon::today()->addMonths(12)->toDateString(), ['class'=>'form-control span6','rows'=>'5']) !!}

    <div class="form-group col-lg-4 col-sm-offset-4">
        {!! Form::submit('SignUp', ['class'=>'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}
    



    <br><br><br>



    <div class="col-lg-12">
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
                url: "<?php echo route('select-area') ?>",
                method: 'POST',
                data: {city:city, _token:token},
                success: function(data) {
                    $("select[name='area']").html('');
                    $("select[name='area']").html(data.options);
                }
            });
        });
    </script>



</div>


        
</body>
</html>
