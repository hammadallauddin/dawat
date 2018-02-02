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
            <a class="navbar-brand" href="#"><img class="logo-custom" src="{{asset('/img/logo180-50.jpg')}}" alt=""  /></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right">
                <li ><a href="#home">HOME</a></li>
                <li><a href="#features-sec">SEARCH</a></li>
                <li><a href="#faculty-sec">OUR TEAM</a></li>
                <li><a href="#contact-sec">CONTACT</a></li>

            </ul>
        </div>

    </div>
</div>
<!--NAVBAR SECTION END-->

<div class="home-sec" id="home" >
    <div class="overlay">
        <div class="container">
            <div class="row text-center " >

                <div class="col-lg-12  col-md-12 col-sm-12">

                    <div class="flexslider set-flexi" id="main-section" >
                        <ul class="slides move-me">
                            <!-- Slider 01 -->


                                <h1>WELCOME TO DAWAT.COM</h1>


                            </li>
                            <!-- End Slider 01 -->

                            <!-- Slider 02 -->

                                <h1>DISCOVER BEST VENUES ONLINE</h1>

                            </li>
                            <!-- End Slider 02 -->

                            <!-- Slider 03 -->


                                <h1>BOOK YOUR VENUE ONLINE</h1>
                            </li>
                            <!-- End Slider 03 -->
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
<!--HOME SECTION END-->
<div  class="tag-line" >
    <div class="container">
        <div class="row  text-center" >

            <div class="col-lg-12  col-md-12 col-sm-12">

                <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i> WELCOME <i class="fa fa-circle-o-notch"></i> </h2>
            </div>
        </div>
    </div>

</div>
<!--HOME SECTION TAG LINE END-->
<div id="features-sec" class="container set-pad" >
    <div class="row text-center">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
            <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line">SEARCH </h1>

        </div>

    </div>
    <!--/.HEADER LINE END-->
    <div id="fullForm">
        <div id="leftSelect">
            <h3>Search By:</h3>

            {!! Form::open() !!}
                <select name="selection" class="form-control">
                    <option default value="0">--Select--</option>
                    <option value="1">Name</option>
                    <option value="2">Area</option>
                    <option value="3">Price</option>
                    <option value="4">Capacity</option>
                </select>
            {!! Form::close() !!}



            <div id="form1" style='display:none;'>
                <br>
                {!! Form::open(['method'=>'POST', 'action'=>'ConsumerController@searchByName']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Enter Name:') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Search', ['class'=>'btn btn-warning col-sm-3']) !!}
                    </div>

                {!! Form::close() !!}
            </div>



            <div id="form2" style='display:none;' class="col-lg-12">
                {!! Form::open(['method'=>'POST', 'action'=>'ConsumerController@searchByArea']) !!}
                        <br>
                        <div class="col-lg-12">
                            {!! Form::label('city', 'City:') !!}
                            <br>
                            {!! Form::select('city',[0 => '-Select-']+$cities ,0, ['class'=>'col-lg-10 form-control','multiple' => 'multiple']) !!}
                            <br>
                        </div>
                        <br><br>
                        <div class="col-lg-12">
                            <br>
                            {!! Form::label('area', 'Area:') !!}
                            <br>
                            {!! Form::select('area',[0=>'-Select- default'] ,0,  ['class'=>'col-lg-10 form-control','multiple' => 'multiple']) !!}
                        </div>
                        <br>
                        <div class="form-group col-lg-12">
                            <br>
                            {!! Form::submit('Search', ['class'=>'btn btn-warning col-sm-3']) !!}
                        </div>
                    {!! Form::close() !!}
            </div>

            <div id="form3" style='display:none;'>
                <br>
                {!! Form::open(['method'=>'POST', 'action'=>'ConsumerController@searchByRate']) !!}

                <div class="form-group">
                    {!! Form::label('min_rate', 'Enter Minimum Rate:') !!}
                    {!! Form::text('min_rate', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('max_rate', 'Enter Maximum Rate:') !!}
                    {!! Form::text('max_rate', null, ['class'=>'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::submit('Search', ['class'=>'btn btn-warning col-sm-3']) !!}
                </div>

                {!! Form::close() !!}
            </div>

            <div id="form4" style='display:none;'>
                <br>
                {!! Form::open(['method'=>'POST', 'action'=>'ConsumerController@searchByCapacity']) !!}

                <div class="form-group">
                    {!! Form::label('min_capacity', 'Enter Minimum Capacity:') !!}
                    {!! Form::text('min_capacity', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('max_capacity', 'Enter Maximum Capacity:') !!}
                    {!! Form::text('max_capacity', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Search', ['class'=>'btn btn-warning col-sm-3']) !!}
                </div>

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
    </div>
</div>
</div>

<!-- VENUE SECTION END-->
<div id="faculty-sec" >
    <div class="container set-pad">
        <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">OUR TEAM </h1>
                <p data-scroll-reveal="enter from the bottom after 0.3s">
                    We suggest best venues for<br>Weddings&nbsp&nbsp&nbsp&nbspBirthday Parties&nbsp&nbsp&nbsp&nbspGraduations&nbsp&nbsp&nbsp&nbspRehearsals&nbsp&nbsp&nbsp&nbspDinners&nbsp&nbsp&nbsp&nbspCompany Meetings&nbsp&nbsp&nbsp&nbspClass Reunions&nbsp&nbsp&nbsp&nbsp& other events
                </p>
            </div>

        </div>
        <!--/.HEADER LINE END-->

        <div class="row" >


            <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.4s">
                <div class="faculty-div">
                    <img src="{{asset('/img/team/1.jpg')}}"  height="300px" width="300px"  class="img-rounded" />
                    <h3 >Hammad Allauddin </h3>
                    <hr />
                </div>
            </div>
            <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.5s">
                <div class="faculty-div">
                    <img src="{{asset('/img/team/2.jpg')}}"  height="300px" width="300px" class="img-rounded" />
                    <h3 >Zameer Ali</h3>
                    <hr/>


                </div>
            </div>
            <div class="col-lg-4  col-md-4 col-sm-4" data-scroll-reveal="enter from the bottom after 0.6s">
                <div class="faculty-div">
                    <img src="{{asset('/img/team/3.jpg')}}"  height="300px" width="300px" class="img-rounded"/>
                    <h3 >Ibrahim Sheikh</h3>
                    <hr />
                </div>
            </div>

        </div>
    </div>
</div>

<!-- TEAM SECTION END-->
<div id="contact-sec"   >
    <div class="overlay">
        <div class="container set-pad">
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line" >CONTACT US  </h1>
                    <p data-scroll-reveal="enter from the bottom after 0.3s">
                        Feel free to contact us using the form given below or in any of the following ways.
                    </p>
                </div>

            </div>
            <!--/.HEADER LINE END-->
            <div class="row set-row-pad"  data-scroll-reveal="enter from the bottom after 0.5s" >


                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">

                    {!! Form::open(['method'=>'POST', 'action'=>'ConsumerController@sendFeedback']) !!}

                    <div class="form-group">
                        {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Your Name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Your Email']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('message', null, ['class'=>'form-control','placeholder'=>'Message']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('SEND', ['class'=>'btn btn-info btn-block btn-lg']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

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
    </div>
</div>
<div class="container">
    <div class="row set-row-pad"  >
        <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 " data-scroll-reveal="enter from the bottom after 0.4s">

            <h2 ><strong>For More </strong></h2>
            <hr />
            <div>

            <h4><strong>Call:</strong>  0331-2934691</h4>
            <h4><strong>Email: </strong>dawatvenue0@gmail.com</h4>
        </div>

    </div>
    <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1" data-scroll-reveal="enter from the bottom after 0.4s">

        <h2 ><strong>Social Conectivity </strong></h2>
        <hr />
        <div >
            <a href="https://www.facebook.com/dawatvenue0/">  <img src="{{asset('/img/Social/facebook.png')}}" alt="" /> </a>
            <a href="https://plus.google.com/101991599336095694677"> <img src="{{asset('/img/Social/google-plus.png')}}" alt="" /></a>
            <a href="https://twitter.com/hammadallauddin"> <img src="{{asset('/img/Social/twitter.png')}}" alt="" /></a>
        </div>
    </div>
</div>
</div>
<!-- CONTACT SECTION END-->
<div id="footer">
    &copy 2017 dawat.com | All Rights Reserved  </div>
<!-- FOOTER SECTION END-->


<script type="text/javascript">
    $("select[name='selection']").change(function(){
        var selection = $(this).val();

        if(selection == '0') {
            $("#form1").hide();
            $("#form2").hide();
            $("#form3").hide();
            $("#form4").hide();
        }
        else if(selection == '1'){
            $("#form1").show();
            $("#form2").hide();
            $("#form3").hide();
            $("#form4").hide();
        }
        else if(selection == '2'){
            $("#form1").hide();
            $("#form2").show();
            $("#form3").hide();
            $("#form4").hide();
        }

        else if(selection == '3'){
            $("#form1").hide();
            $("#form2").hide();
            $("#form3").show();
            $("#form4").hide();
        }

        else if(selection == '4'){
            $("#form1").hide();
            $("#form2").hide();
            $("#form3").hide();
            $("#form4").show();
        }
    });
</script>

<script type="text/javascript">
    $("select[name='city']").change(function(){
        var city = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('consumer.ajax-search-select') ?>",
            method: 'POST',
            data: {city:city, _token:token},
            success: function(data) {
                $("select[name='area']").html('');
                $("select[name='area']").html(data.options);
            }
        });
    });
</script>


<!--  Jquery Core Script -->
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
