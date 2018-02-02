<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <!-- BOOTSTRAP STYLES-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

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
<body>
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
                    </ul>
                </div>

            </div>
        </div>


        <div  class="tag-line" >
            <div class="container">
                <div class="row  text-center" >

                    <div>
                        <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i> WELCOME <i class="fa fa-circle-o-notch"></i> </h2>
                    </div>
                </div>
            </div>

        </div>

        <div>
            <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line text-center">BOOKINGS </h1>
            @if(Session::has('submitted'))
                <p class="alert bg-success ">{{Session('submitted')}}</p>
            @endif

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div>
                        <div class="col-lg-6 col-lg-offset-3">

                            <div class="panel panel-primary">

                                <div class="panel-heading">

                                    BOOKING

                                </div>

                                <div class="panel-body" >

                                    {!! $calendar->calendar() !!}

                                    {!! $calendar->script() !!}

                                </div>

                            </div>

                        </div>
                </div>
            </div>
                <br>
            <div style="display:block">
                <h3>Booking Instructions</h3>
                <p>1.Choose Between Available Dates<br>2.Contact us for pricing details<br>3.Fill the Booking Form and Pay advance of Rupees 20000 <strong>(Non-refundable)</strong><br>4.Pay the remaining amount within one week<br>Note. If remaining payment would not be cleared within 10 days the booking will be cancelled</p>
            </div>

                <a href="{{Route('booking.request',$hall->id)}}" class="btn btn-warning col-lg-4 col-lg-offset-1">Request Booking</a>

                <a href="{{Route('consumer.details',$hall->id)}}" class="btn btn-sm btn-primary col-lg-4 col-lg-offset-1">Back To Details</a>

        </div>
</body>
</html>