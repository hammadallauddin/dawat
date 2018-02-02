<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dawat</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="icon" href="{{asset('/img/logo180-50.jpg')}}" type="image/x-icon">
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <!-- FONT AWESOME CSS -->
    <link href="{{asset('/css/font-awesome.css')}}" rel="stylesheet">
    <!-- FLEXSLIDER CSS -->
    <link href="{{asset('/css/flexslider.css')}}" rel="stylesheet">
    <!-- CUSTOM STYLE CSS -->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>
<body >

<div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img class="logo-custom" src="{{asset('/img/logo180-50.jpg')}}" alt=""  /></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="/">HOME</a></li>
                <li ><a href="{{Route('consumer.bookings',$hall->id)}}">BOOKINGS</a></li>
            </ul>
        </div>

    </div>
</div>
<!--NAVBAR SECTION END-->

<!--HOME SECTION END-->
<div  class="tag-line" >
    <div class="container">
        <div class="row  text-center" >

            <div>
                <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i> WELCOME <i class="fa fa-circle-o-notch"></i> </h2>
            </div>
        </div>
    </div>

</div>
<!--HOME SECTION TAG LINE END-->
<div id="features-sec">
    <div class="col-lg-12">
        <div>
            <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line text-center">Request Booking </h1>
            <div id="page-wrapper" >
                <div id="page-inner">

                    <div class="alert alert-warning">
                        <p align="center">You would have to pay Rs. 20000 as advance for booking the venue</p>
                    </div>

                    {!! Form::open(['method'=>'POST', 'action'=>['ConsumerController@bookingRequest',$hall->id]]) !!}

                    <br>
                    {!! Form::label('fname', 'First Name:') !!}
                    {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
                    <br>
                    {!! Form::label('lname', 'Last Name:') !!}
                    {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
                    <br>
                    {!! Form::label('contact', 'Contact:') !!}
                    {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                    <br>
                    {!! Form::label('nic', 'NIC Number:') !!}
                    {!! Form::text('nic', null, ['class'=>'form-control']) !!}
                    <br>
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['class'=>'form-control']) !!}
                    <br>
                    {!! Form::label('date', 'Date:') !!}
                    {!! Form::date('date', null, ['class'=>'form-control']) !!}

                    <br>
                    {!! Form::submit('Request Booking', ['class'=>'btn btn-warning']) !!}

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

            </div>

        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.js') }}"></script>
    <!--  Core Bootstrap Script -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <!--  Flexslider Scripts -->
    <script type="text/javascript" src="{{ asset('js/flexslider.js') }}"></script>
    <!--  Scrolling Reveal Script -->
    <script type="text/javascript" src="{{ asset('js/scrollReveal.js') }}"></script>
    <!--  Scroll Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <!--  Custom Scripts -->
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
