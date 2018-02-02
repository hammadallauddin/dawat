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
            <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line text-center">RESULTS </h1>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div>
                        <div>
                            <table class="table table-borderless" >
                                <tbody>
                                <thead>
                                <tr>
                                    <td class="col-lg-1"><h3>Name</h3></td>
                                    <td class="col-lg-1"><h3>Area</h3></td>
                                    <td class="col-lg-1"><h3>City</h3></td>
                                    <td class="col-lg-1"><h3>Capacity</h3></td>
                                    <td class="col-lg-1"><h3>Price</h3></td>
                                </tr>
                                </thead>
                                    <tbody>
                                    @foreach($halls as $hall)
                                        @if($hall->user->is_active == 1 && $hall->user->expire >= Carbon\Carbon::now() && $hall->user->is_verified == 1)
                                            <tr>
                                                <td class="col-lg-1">{{$hall->name}}</td>
                                                <td class="col-lg-1">{{$hall->area->name}}</td>
                                                <td class="col-lg-1">{{$hall->area->city->name}}</td>
                                                <td class="col-lg-1">{{number_format($hall->capacity,0)}} People</td>
                                                <td class="col-lg-1">{{number_format($hall->min_price, 0)}} - {{number_format($hall->max_price, 0)}} Rupees</td>
                                                <td class="col-lg-1"><a class="btn btn-warning" href="{{Route('consumer.details',$hall->id)}}">Details</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>


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
