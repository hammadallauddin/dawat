@extends('layout.user')

@section('title')
    Dashboard
    @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12">

            <h2 style="color: #f0ad4e">{{$user->halls->name}}</h2>
            <h3>Welcome {{$user->fname}} {{$user->lname}}</h3>
            <h4>Here you can view and edit the details of your banquet and change your password.</h4>
            <hr>
                @if(Session::has('deleted'))
                    <p class="bg-danger ">{{Session('deleted')}}</p>
                @elseif(Session::has('created'))
                    <p class="bg-success ">{{Session('created')}}</p>
                @elseif(Session::has('updated'))
                    <p class="bg-success ">{{Session('updated')}}</p>
                @endif

                <div>
                    <h2><a class="col-lg-3 btn btn-success" href="{{Route('user.booking.create')}}">Create Booking</a></h2>
                    <br><br><br>
                    <div class="col-lg-9">


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
    @endsection