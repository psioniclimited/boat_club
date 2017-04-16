@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
@endsection
@section('page_header')
Register User
@endsection
@section('page_description')
Register a new User with Admin LTE
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
                    <h3 class="box-title">User Create Page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form starts here --> 
                <!-- create user form submit-->
 
                {!! Form::open(array('route'=>'user.store','id'=>'add_user_form','class' => 'form-horizontal')) !!}
                 <div class="box-body">
                    <div class="col-md-6"> 
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name" class="control-label">name*</label> 
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{old('name')}}">
                             @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <label for="email" class="control-label">Email*</label> 
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{old('email')}}"> 
                             @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('role')) has-error @endif" >
                            <label for="roles" class="control-label">Role*</label> 
                            <select class="form-control" name="role" >
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>  
                             @if ($errors->has('role')) <p class="help-block">{{ $errors->first('role') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="password" class="control-label">Password*</label> 
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"> 
                             @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif  
                        </div>
                        <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                            <label for="password_confirmation" class="control-label">Confirm Password*</label> 
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again"> 
                             @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif 
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
    $('#add_user_form').validate({
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
            password: {required: true, minlength: 6},
            password_confirmation: {required: true, equalTo: "#password"},
            role: {required: true}
        },
        messages: {
            name: {required: "Please give name"},
            email: {required: "Insert email address"},
            password: {required: "Six digit password"},
            password_confirmation: {required: "Re-enter same password"},
            role: {required: "Please select a role"}
        }
    });


});



</script>

@endsection
