@extends('layout.user');


@section('title')
    Show Booking
@endsection


@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: #f0ad4e"> Show Booking</h2>
            </div>

        </div>
        <!-- /. ROW  -->
        <hr />

        @if(Session::has('updated'))
            <p class="alert bg-success ">{{Session('updated')}}</p>
        @endif

        <div>
            <table>
                <tr>
                    <td class="col-lg-2"><h3>Name:</h3></td>
                    <td class="col-lg-3"><h4>{{$booking->fname}} {{$booking->lname}}</h4></td>
                </tr>


                <tr>
                    <td class="col-lg-1"><h3>Contact:</h3></td>
                    <td class="col-lg-3"><h4>{{$booking->contact}}</h4></td>
                </tr>

                <tr>
                    <td class="col-lg-1"><h3>Email:</h3></td>
                    <td class="col-lg-3"><h4>{{$booking->email}}</h4></td>
                </tr>

                <tr>
                    <td class="col-lg-1"><h3>NIC:</h3></td>
                    <td class="col-lg-3"><h4>{{$booking->email}}</h4></td>
                </tr>

                <tr>
                    <td class="col-lg-1"><h3>Confirmation:</h3></td>
                    @if($booking->is_confirmed == 0)
                        <td class="col-lg-3"><h4>Not Confirmed</h4></td>
                    @else
                        <td class="col-lg-3"><h4>Confirmed</h4></td>
                    @endif
                </tr>

                <tr>
                    <td class="col-lg-1"><h3>Date:</h3></td>
                    <td class="col-lg-3"><h4>{{ Carbon\Carbon::parse($booking->date)->format('l j F Y') }}</h4></td>
                </tr>
                <tr>
                    <td class="col-lg-1"><h3></h3></td>
                    <td class="col-lg-3"><h4>{{ Carbon\Carbon::parse($booking->date)->diffForHumans() }}</h4></td>
                </tr>
            </table>
            <br><br>
            <div class="col-lg-10 col-lg-offset-1">
                <h2><a class="col-lg-3  btn btn-primary" href="{{Route('user.booking.edit',$booking->id)}}">Edit Booking</a></h2>

                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['UserBookingController@destroy',$booking->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                    {!! Form::submit('Delete' , ['class'=>'col-lg-3 btn btn btn-danger col-lg-offset-1']) !!}
                    {!! Form::close() !!}
                </td>
            </div>
            <script>

                function ConfirmDelete()
                {
                    var x = confirm("Are you sure you want to delete?");
                    if (x)
                        return true;
                    else
                        return false;
                }

            </script>
        </div>


    </div>
@endsection