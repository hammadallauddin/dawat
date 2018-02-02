@extends('layout.user');


@section('title')
    Pending Booking
@endsection


@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: #f0ad4e"> Pending Booking</h2>
            </div>

        </div>
        <!-- /. ROW  -->
        <hr />

        @if(Session::has('confirmed'))
            <p class="alert bg-success ">{{Session('confirmed')}}</p>
        @endif
        <div>
            <table class="table">
                <thead>
                <tr>
                    <td><h3>Name</h3></td>
                    <td><h3>Email</h3></td>
                    <td><h3>Contact</h3></td>
                    <td><h3>NIC</h3></td>
                    <td><h3>Date</h3></td>
                </tr>
                </thead>
                <tbody>
                    @foreach($pendings as $pending)
                       <tr>
                           <td>{{$pending->fname}} {{$pending->lname}}</td>
                           <td>{{$pending->email}}</td>
                           <td>{{$pending->contact}}</td>
                           <td>{{$pending->nic}}</td>
                           <td>{{$pending->date}}</td>
                           <td><a href="{{Route('user.confirm',$pending->id)}}" class="btn btn-sm btn-primary">Confirm</a></td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>
@endsection