<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <!-- CUSTOM STYLES-->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
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
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">Admin Panel</a>
        </div>
        <div style="color: white;
              padding: 15px 50px 5px 50px;
              float: right;
              font-size: 16px;">
            <a href="{{route('admin.logout')}}" class="btn btn-warning square-btn-adjust">Logout</a> </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li><a  href="{{Route('admin.dashboard')}}">Home</a></li>
                <li><a  href="{{Route('admin.admins.index')}}">Admins</a></li>
                <li><a  href="{{Route('admin.users.index')}}">Users</a></li>
                <li><a  href="{{Route('admin.deactivated')}}">Deactive Users</a></li>
                <li><a  href="{{Route('admin.cities.index')}}">Cities</a></li>
                <li><a  href="{{Route('admin.areas.index')}}">Areas</a></li>
                <li><a  href="{{Route('admin.changePassword',Session::get('AdminLoggedIn')->id)}}">Change Password</a></li>
            </ul>
        </div>
    </nav>
    <!-- /. NAV SIDE  -->
    @yield('content')
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/jquery-1.10.2.js') }}"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- METISMENU SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/jquery.metisMenu.js') }}"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>



</body>
</html>
