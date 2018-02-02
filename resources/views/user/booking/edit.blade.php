@extends('layout.user')

@section('title')
    Edit Booking
@endsection


@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: #f0ad4e">Edit Booking</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        {!! Form::model($booking,['method'=>'PATCH', 'action'=>['UserBookingController@update',$booking->id]]) !!}

        <br>
        {!! Form::label('fname', 'First Name:') !!}
        {!! Form::text('first_name', $booking->fname, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('lname', 'Last Name:') !!}
        {!! Form::text('last_name', $booking->lname, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('contact', 'Contact:') !!}
        {!! Form::text('contact', $booking->contact, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('nic', 'NIC Number:') !!}
        {!! Form::text('nic', $booking->nic, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', $booking->email, ['class'=>'form-control']) !!}
        <br>
        {!! Form::label('date', 'Date:') !!}
        {!! Form::date('date', $booking->date, ['class'=>'form-control']) !!}
        <br>
        <div class="form-group">
            {!! Form::label('is_confirmed', 'Is Confirmed:') !!}<br>
            {!! Form::checkbox('is_confirmed', $booking->is_confirmed, null, ['class' => 'field']) !!}
        </div>
        <br>

        {!! Form::submit('Update Booking', ['class'=>'btn btn-warning']) !!}

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