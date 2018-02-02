<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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



    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('/css/font-awesome.css')}}" rel="stylesheet">
    <!-- CUSTOM STYLES-->
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('user.dashboard')}}">User Panel</a>
        </div>
        <div style="color: white;
              padding: 15px 50px 5px 50px;
              float: right;
              font-size: 16px;">
            <a href="{{route('user.logout')}}" class="btn btn-warning square-btn-adjust">Logout</a> </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li><a  href="{{Route('user.dashboard')}}">Home</a></li>
                <li><a  href="{{Route('user.viewProfile')}}">View Profile</a></li>
                <li><a  href="{{Route('user.editProfile',Session::get('UserLoggedIn')->id)}}">Edit Profile</a></li>
                <li><a  href="{{Route('user.pending')}}">Pending Bookings</a></li>
                <li><a  href="{{Route('user.editPassword',Session::get('UserLoggedIn')->id)}}"> Change Password</a></li>
                </ul>
        </div>
    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
        @yield('content')
        <!-- /. ROW  -->
            <hr />

        </div>
        <!-- /. PAGE INNER  -->
    </div>

    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->

<!-- BOOTSTRAP SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- METISMENU SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/jquery.metisMenu.js') }}"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>



</body>
</html>
