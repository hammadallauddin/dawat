@extends('layout.admin');


@section('title')
    Edit City
@endsection


@section('content')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Edit City</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div>

                {!! Form::model($city, ['method'=>'PATCH', 'action'=>['AdminCityController@update', $city->id]]) !!}
                <br>
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $city->fname, ['class'=>'form-control']) !!}
                <br>
                {!! Form::submit('Edit City', ['class'=>'btn btn-warning']) !!}

                {!! Form::close() !!}

            </div>
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