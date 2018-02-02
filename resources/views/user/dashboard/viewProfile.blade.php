@extends('layout.user')

@section('title')
    View Profile
@endsection


@section('content')
    <link href="{{asset('css/slider/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/slider/ie7.css')}}" rel="stylesheet">
    <link href="{{asset('css/slider/ie8.css')}}" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">
            <h2 style="color: #f0ad4e">View Profile</h2>
        </div>

    </div>
    <!-- /. ROW  -->
    <hr />

    @if(Session::has('updated'))
        <p class="alert bg-success ">{{Session('updated')}}</p>
    @elseif(Session::has('created'))
        <p class="alert bg-success ">{{Session('created')}}</p>
    @elseif(Session::has('deleted'))
        <p class="alert bg-danger ">{{Session('deleted')}}</p>
    @endif

    <br>
    <div class="row col-lg-12">
        {!! Form::open(['method'=>'POST', 'action'=>'UserController@storePhotos','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Upload Photo', ['class'=>'btn btn-warning']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div id="myCarousel" class="carousel slide col-lg-9 col-lg-offset-1" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            @foreach($user->halls->photos as $photo)
                <li data-target="#myCarousel" data-slide-to="1"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{asset('img/loginb.jpg')}}" alt="images">
                <div class="carousel-caption">
                    <h3>Welcome</h3>
                    <p>Here you can view your banquet's images and information</p>
                </div>
            </div>

            @foreach($user->halls->photos as $photo)
                <div class="item">
                    <img src="/images/halls/{{$photo->file}}" alt="image">
                    <div class="carousel-caption">
                        {!! Form::open(['method'=>'DELETE','action'=>['UserController@deletePhotos',$photo->id]]) !!}
                        {!! Form::submit('Delete' , ['class'=>'btn btn-sm btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
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



        <div>
        <table>
            <tr>
                <td class="col-lg-2"><h3>Name:</h3></td>
                <td class="col-lg-3"><h4>{{$user->fname}} {{$user->lname}}</h4></td>
            </tr>


            <tr>
                <td class="col-lg-1"><h3>Username:</h3></td>
                <td class="col-lg-3"><h4>{{$user->username}}</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Email:</h3></td>
                <td class="col-lg-3"><h4>{{$user->email}}</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Contact No:</h3></td>
                <td class="col-lg-3"><h4>{{$user->contact}} / {{$user->halls->contact}}</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Banquet Name:</h3></td>
                <td class="col-lg-3"><h4>{{$user->halls->name}}</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Capacity:</h3></td>
                <td class="col-lg-3"><h4>{{number_format($user->halls->capacity,0)}} People</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Price:</h3></td>
                <td class="col-lg-3"><h4>{{number_format($user->halls->min_price,0)}} - {{number_format($user->halls->max_price,0) }} Rupees</h4></td>
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Area:</h3></td>
                @if($user->halls->area != null)
                    <td class="col-lg-3"><h4>{{$user->halls->area->name}}</h4></td>
                @else
                    <td class="col-lg-3"><h4>NA</h4></td>
                @endif
            </tr>

            <tr>
                <td class="col-lg-1"><h3>City:</h3></td>
                @if($user->halls->area != null)
                    @if($user->halls->area->city != null)
                        <td class="col-lg-3"><h4>{{$user->halls->area->city->name}}</h4></td>
                    @else
                        <td class="col-lg-3"><h4>NA</h4></td>
                    @endif
                @else
                    <td class="col-lg-3"><h4>NA</h4></td>
                @endif
            </tr>

            <tr>
                <td class="col-lg-1"><h3>Description:</h3></td>
                <td class="col-lg-3"><h4>{{$user->halls->desc}}</h4></td>
            </tr>

        </table>
    </div>
    <br>
@endsection