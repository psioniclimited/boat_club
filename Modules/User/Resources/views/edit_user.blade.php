@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
@endsection
@section('page_header')
Register User
@endsection
@section('page_description')
Edit User
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('create_user') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Edit Page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form starts here --> 
                <!-- create user form submit-->
                {!! Form::open(array('route' => array('user.update', $user->id), 'id' => 'edit_user_form', 'method'=>'PUT')) !!}          
                <div class="box-body">
                    @if (count($errors) > 0)
<!--                     <div class="alert alert-danger alert-login col-md-12">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div> -->
                    @endif
                    <div class="col-md-6"> 
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name" class="control-label">name*</label> 
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$user->name}}"> 
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <label for="email" class="control-label">Email*</label> 
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$user->email}}"> 
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('role')) has-error @endif">
                            <label for="roles" class="control-label">Rolea*</label> 
                            <select class="form-control" name="role" >
                                @foreach($roles as $role)
                                    @if($role->id == $user->roles->first()->role_id)
                                    <option value="{{$role->id}}" selected>{{$role->display_name}}</option>
                                    @else
                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endif
                                @endforeach
                            </select> 
                            @if ($errors->has('role')) <p class="help-block">{{ $errors->first('role') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="password" class="control-label">Password*</label> 
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif  
                        </div>
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="password_confirmation" class="control-label">Confirm Password*</label> 
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again"> 
                            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif 
                        </div> 
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
                <!-- /.form ends here -->
            </div>
            <!-- /.box -->
        </div>

    </div>    
</section>
<!-- /.content -->

@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script>

    $(document).ready(function () {
    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });
    // initialize validate plugin on the form
    $('#edit_user_form').validate({
        errorPlacement: function (error, element) {
            var lastError = $(element).data('lastError'),
            newError = $(error).text();

            $(element).data('lastError', newError);

            if (newError !== '' && newError !== lastError) {
                $(element).tooltipster('content', newError);
                $(element).tooltipster('show');
            }
        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },
        rules: {
            name: {required: true, minlength: 4},
            email: {required: true, email: true}, 
            role: {required: true}
        },
        messages: {
            name: {required: "Please give name"},
            email: {required: "Insert email address"}, 
            role: {required: "Please select a role"}
        }
    });


});
</script>
@endsection
