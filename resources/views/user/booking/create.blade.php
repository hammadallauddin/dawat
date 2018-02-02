@extends('layout.user')

@section('title')
    Create Booking
@endsection


@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: #f0ad4e">Create Booking</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        {!! Form::open(['method'=>'POST', 'action'=>'UserBookingController@store']) !!}

        <br>
        {!! Form::label('fname', 'First Name:') !!}
        {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('lname', 'Last Name:') !!}
        {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('contact', 'Contact:') !!}
        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('nic', 'NIC Number:') !!}
        {!! Form::text('nic', null, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('date', 'Date:') !!}
        {!! Form::date('date', null, ['class'=>'form-control']) !!}
        <br>
        <div class="form-group">
            {!! Form::label('is_confirmed', 'Is Confirmed:') !!}<br>
            {!! Form::checkbox('is_confirmed', 1, null, ['class' => 'field']) !!}
        </div>
        <br>
        {!! Form::submit('Create Booking', ['class'=>'btn btn-warning']) !!}

        {!! Form::close() !!}
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
@endsection