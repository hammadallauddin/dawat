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
            <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line text-center">{{$hall->name}} </h1>

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div>
                        <div class="col-lg-6 col-lg-offset-3">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    @foreach($hall->photos as $photo)
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                    @endforeach
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="{{asset('img/loginb.jpg')}}" alt="images">
                                        <div class="carousel-caption">
                                            <h3>Welcome</h3>
                                        </div>
                                    </div>

                                    @foreach($hall->photos as $photo)
                                        <div class="item">
                                            <img src="/images/halls/{{$photo->file}}" alt="image">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-offset-1">
                        <table class="table no-boder">
                            <tbody>
                                <tr>
                                    <td><h3>Owner Name:</h3></td>
                                    <td><h3>{{$hall->user->fname}} {{$hall->user->lname}}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Contact:</h3></td>
                                    <td><h3>{{$hall->contact}} / {{$hall->user->contact}}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Capacity:</h3></td>
                                    <td><h3>{{number_format($hall->capacity,0)}} People</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Price:</h3></td>
                                    <td><h3>{{number_format($hall->min_price, 0)}} - {{number_format($hall->max_price, 0)}} Rupees</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Area:</h3></td>
                                    <td><h3>{{$hall->area->name}}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>City:</h3></td>
                                    <td><h3>{{$hall->area->city->name}}</h3></td>
                                </tr>
                                <tr>
                                    <td><h3>Description:</h3></td>
                                    <td><h3>{{$hall->desc}}</h3></td>
                                </tr>
                                <tr>
                                    <td  class="col-lg-6">
                                        <a href="{{Route('consumer.bookings',$hall->id)}}" class="btn btn-sm btn-primary col-lg-4 col-lg-offset-7">Book</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <br>
                <hr>
                <br>
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
