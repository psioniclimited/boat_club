@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">  
<style>
    .col-md-6{
        padding-right: 20px;
    }
    tr th.select-checkbox.selected::after {
        content: "✔";
        margin-top: -11px;
        margin-left: -4px;
        text-align: center;
        text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
    }

</style>

@endsection
@section('page_header')
Attendance
@endsection
@section('page_description')
Manage Attendance
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('attendance') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Attendance</h3>
                </div>
                {!! Form::open(array('route'=>'attendance.store','id'=>'attendance_form','class' => 'form-horizontal')) !!}

                <div class="box-body">


                    <!-- <div class="col-md-12"> -->
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="name" class="control-label">Type*</label> 
                            <select name="attendance_type" id="attendance_type" class="form-control">
                                <option value="1">Punch In</option>
                                <option value="2">Punch Out</option>
                            </select> 
                        </div>
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group @if ($errors->has('working_date')) has-error @endif">
                            <label for="name" class="control-label">Date*</label> 
                            <input type="text" class="form-control" id="working_date" name="working_date" placeholder="Enter Date" value="{{old('working_date')}}" > 
                            @if ($errors->has('working_date')) <p class="help-block">{{ $errors->first('working_date') }}</p> @endif                             
                        </div>
                    </div>
                    <div class="col-md-6 bootstrap-timepicker"> 
                        <div class="form-group @if ($errors->has('time')) has-error @endif">
                            <label for="name" class="control-label">Time*</label> 
                            <input type="text" class="form-control" id="time" name="time" placeholder="Enter Time" value="{{old('punch_in')}}"> 
                            @if ($errors->has('time')) <p class="help-block">{{ $errors->first('time') }}</p> @endif                             
                        </div>
                    </div>  

<!--                 </div>

    <div class="col-md-12"> -->
      <div class="col-md-6">  

        <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
          <label for="name" class="control-label">Employee*</label>
          <select class="form-control" id="employees_master_id" name="employees_master_id" > 
          </select>                 
          @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
      </div>  

  </div><!-- /.col-md-6 -->


  <div class="col-md-6">  
    <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
      <label for="name" class="control-label">Employee Name*</label>
      <input type="text" class="form-control" id="employee_fullname" readonly=""> 
      @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
  </div>   
</div><!-- /.col-md-6 -->
<div class="col-md-6">  
    <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
      <label for="name" class="control-label">Employee Contact*</label>
      <input type="text" class="form-control" id="contact_number" readonly=""> 
      @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
  </div>   
</div><!-- /.col-md-6 -->


<!-- </div> -->



<!-- /.col -->
</div>

<div class="box-footer"> 
    <button type="submit" class="btn btn-primary pull-left">Submit</button>
</div>

</div>
<!-- /.box -->
</div>

</div>    
</section>
{!! Form::close() !!}
<!-- /.form ends here -->
<!-- /.content -->


@endsection


@section('scripts')

<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script src="{{asset('bower_components/AdminLTE')}}/plugins/timepicker/bootstrap-timepicker.js"></script>



<script src="{{asset('bower_components/AdminLTE')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>   
<script src="{{asset('js/utils/utils.js')}}"></script>
<script>

    $(document).ready(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })   

    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });

    // initialize validate plugin on the form
    $('#attendance_form').validate({
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
            employees_master_id: {required: true},
            working_date: {required: true},
            time: {required: true},
        },
        messages: {
            employees_master_id: {required: "Please Select and Employee"},
            working_date: {required: "Please give Date"},
            time: {required: "Please give Time"}
        }
    });
     //Date picker
     $('#working_date').datepicker({
      autoclose: true,
       format: 'yyyy-mm-dd'
  });

    //Timepicker
    $("#time").timepicker({
      showInputs: false
  });



    var employees_master_id=$('#employees_master_id'); 
    parameters = { 
      placeholder: "Employee",
      url: '{{URL::to("/")}}/employee/auto/get_employees',
      selector_id:employees_master_id, 
      data:{}
  }

  init_select2(parameters);

  employees_master_id.on("select2:select",function (e) { 
      $('#employee_fullname').val(employees_master_id.select2('data')[0]['employee_fullname']);    
      $('#contact_number').val(employees_master_id.select2('data')[0]['contact_number']);   
  });

  employees_master_id.on("select2:unselect", function(evt) {
   $('#employee_fullname').val("");    
   $('#contact_number').val("");
});









});//document ready



</script>

@endsection
