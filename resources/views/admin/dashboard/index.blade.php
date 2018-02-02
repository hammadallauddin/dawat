@extends('layout.admin');


@section('title')
    Dashboard
    @endsection


@section('content')
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Admin Mode</h2>
                    <h3>Welcome {{$admin->fname}} {{$admin->lname}}</h3>
                    <h4>Here you can view and edit the details of every users.</h4>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    @endsection