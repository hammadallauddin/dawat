@extends('layout.admin');


@section('title')
    Create City
@endsection


@section('content')

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="color: #f0ad4e">Create City</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                {!! Form::open(['method'=>'POST', 'action'=>'AdminCityController@store']) !!}

                <br>
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}

                <br>

                {!! Form::submit('Create City', ['class'=>'btn btn-warning']) !!}

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
            <!-- /. PAGE INNER  -->
        </div>
    @endsection