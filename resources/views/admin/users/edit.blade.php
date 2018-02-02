@extends('layout.admin');


@section('title')
    Edit User
@endsection


@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: #f0ad4e">Edit User</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div>
                {!! Form::model($user,['method'=>'PATCH', 'action'=>['AdminUserController@update',$user->id]]) !!}
                <div class="form-group">
                    {!! Form::label('first_name', 'First Name:') !!}
                    {!! Form::text('first_name', $user->fname, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('last_name', 'Last Name:') !!}
                    {!! Form::text('last_name', $user->lname, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('username', 'Username:') !!}
                    {!! Form::text('username', $user->username, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email',  $user->email, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('user_phone', 'User\'s Phone:') !!}
                    {!! Form::text('user_phone', $user->contact, ['class'=>'form-control']) !!}
                </div>

                <div>
                    {!! Form::label('city', 'City:') !!}
                    <select  name="city" id="city" class="form-control">
                        <option default value="">-Select-</option>
                        @foreach($city as $cities)
                            <option default value="{{$cities->id}}">{{$cities->name}}</option>
                        @endforeach
                    </select>
                </div>

                <br>

                <div>
                    {!! Form::label('area', 'Area:') !!}
                    {!! Form::select('area',[''=>'-Select-'] , null, ['class'=>'form-control']) !!}
                </div>
                <br>
                <div class="form-group">
                    {!! Form::label('banquet_name', 'Banquet Name:') !!}
                    {!! Form::text('banquet_name', $user->halls->name, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('is_active', 'Is Active:') !!}<br>
                    {!! Form::checkbox('is_active', 1, $user->is_active, ['class' => 'field']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('banquet_phone', 'Banquets\'s Phone:') !!}
                    {!! Form::text('banquet_phone', $user->halls->contact, ['class'=>'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('capacity', 'Capacity:') !!}
                    {!! Form::text('capacity', $user->halls->capacity, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('minimum_rate', 'Minimum Rate:') !!}
                    {!! Form::text('minimum_rate', $user->halls->min_price, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('maximum_rate', 'Maximum Rate:') !!}
                    {!! Form::text('maximum_rate', $user->halls->max_price, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', $user->halls->desc, ['class'=>'form-control span6','rows'=>'5']) !!}
                </div>

                <br>
                <div class="form-group">
                    {!! Form::submit('Edit User', ['class'=>'btn btn-warning col-sm-3']) !!}
                </div>
                {!! Form::close() !!}
                <br>
                {!! Form::open(['method'=>'DELETE','action'=>['AdminUserController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                <div class="form-group">
                    {!! Form::submit('Delete User' , ['class'=>'btn btn-danger col-sm-3']) !!}
                </div>
                {!! Form::close() !!}
                <br><br>
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
        <!-- /. PAGE INNER  -->
    </div>

    <script type="text/javascript">
        $("select[name='city']").change(function(){
            var city = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('ajax-edit-select') ?>",
                method: 'POST',
                data: {city:city, _token:token},
                success: function(data) {
                    $("select[name='area']").html('');
                    $("select[name='area']").html(data.options);
                }
            });
        });
    </script>
@endsection