@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">

<style>
 .col-md-6,.col-md-5{
  padding-right: 20px !important;
}
.col-md-2>.form-group>label{
  padding-left: 20px;
}

</style>
@endsection

@section('page_header')
Attendance Deduction Setup
@endsection
@section('page_description')
Set up Attendance Deduction Policies
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('attendance_deduction') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12"> 
      {!! Form::open(array('route' => array('attendance_deduction.update', $attendance_deduction->id), 'id' => 'attendance_deduction_form', 'method'=>'PUT')) !!} 



      {!! Form::hidden('id', $attendance_deduction->id) !!}
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Attendance Deduction Policy Create</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12"> 
            <div class="form-group @if ($errors->has('deduction_policy_name')) has-error @endif">
              <label for="name" class="control-label">Policy Name*</label> 
              <input type="text" class="form-control" id="deduction_policy_name" name="deduction_policy_name" placeholder="Enter name" value="{{$attendance_deduction->deduction_policy_name}}" > 
              @if ($errors->has('deduction_policy_name')) <p class="help-block">{{ $errors->first('deduction_policy_name') }}</p> @endif                             
            </div>
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
      </div><!-- /.box -->


      <div class="box box-info">
        <div class="box-body">
          <div class="col-md-6"> 
            <div class="bootstrap-timepicker">
             <div class="form-group @if ($errors->has('late_entry_time')) has-error @endif">
              <label for="name" class="control-label">Late Entry Time</label> 
              <div class="input-group"> 
                <input type="text" class="form-control" id="late_entry_time" name="late_entry_time" placeholder="Enter Time" value="{{$attendance_deduction->late_entry_time}}" > 
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div><!-- /.input group -->
              @if ($errors->has('late_entry_time')) <p class="help-block">{{ $errors->first('late_entry_time') }}</p> @endif                                                 
            </div><!-- /.form group -->
          </div>
        </div>


        <div class="col-md-6"> 
          <div class="bootstrap-timepicker">
            <div class="form-group @if ($errors->has('early_out_time')) has-error @endif">
              <label for="name" class="control-label">Early Out Time</label> 
              <div class="input-group"> 
               <input type="text" class="form-control" id="early_out_time" name="early_out_time" placeholder="Enter Time" value="{{$attendance_deduction->early_out_time}}" > 
               <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            </div><!-- /.input group -->
            @if ($errors->has('early_out_time')) <p class="help-block">{{ $errors->first('early_out_time') }}</p> @endif                                                       
          </div><!-- /.form group -->
        </div>
      </div>  
    </div> <!-- /.box-body --> 
  </div><!-- /.box -->


  <div class="box box-info">
    <div class="box-body">
      <div class="col-md-5"> 
        <div class="form-group @if ($errors->has('late_entry_day_count')) has-error @endif">
          <label for="name" class="control-label">Number Of Late Marks</label> 
          <input type="number" class="form-control" id="late_entry_day_count" name="late_entry_day_count" placeholder="The number of days entering late" value="{{$attendance_deduction->late_entry_day_count}}" > 
          @if ($errors->has('late_entry_day_count')) <p class="help-block">{{ $errors->first('late_entry_day_count') }}</p> @endif                             
        </div>
      </div> 

      <div class="col-md-5"> 
        <div class="form-group @if ($errors->has('late_entry_deduction_day')) has-error @endif">
          <label for="name" class="control-label">Late Mark Deduction </label> 
          <input type="number" class="form-control" id="late_entry_deduction_day" name="late_entry_deduction_day" placeholder="Number of days to be deducted" value="{{$attendance_deduction->late_entry_deduction_day}}" > 
          @if ($errors->has('late_entry_deduction_day')) <p class="help-block">{{ $errors->first('late_entry_deduction_day') }}</p> @endif                             
        </div>
      </div> 

      <div class="col-md-2"> 
        <div class="form-group @if ($errors->has('late_entry_deduction_valid')) has-error @endif">
          <label for="name" class="control-label">Valid </label> 
          <div class="checkbox">
            @if($attendance_deduction->late_entry_deduction_valid==1)
            <label><input type="checkbox" class="minimal" name="late_entry_deduction_valid" id="late_entry_deduction_valid" value="1" checked=""></label>
            @else
            <label><input type="checkbox" class="minimal" name="late_entry_deduction_valid" id="late_entry_deduction_valid" value="1" ></label>
            @endif
          </div>
          @if ($errors->has('late_entry_deduction_valid')) <p class="help-block">{{ $errors->first('late_entry_deduction_valid') }}</p> @endif                             
        </div>
      </div> 
    </div> <!-- /.box-body -->  
  </div><!-- /.box -->



  <div class="box box-info">
    <div class="box-body">

      <div class="col-md-5"> 
        <div class="form-group @if ($errors->has('early_out_day_count')) has-error @endif">
          <label for="name" class="control-label">Number Of Early Out </label> 
          <input type="number" class="form-control" id="early_out_day_count" name="early_out_day_count" placeholder="The number of days leaving early" value="{{$attendance_deduction->early_out_day_count}}" > 
          @if ($errors->has('early_out_day_count')) <p class="help-block">{{ $errors->first('early_out_day_count') }}</p> @endif                             
        </div>
      </div> 

      <div class="col-md-5"> 
        <div class="form-group @if ($errors->has('early_out_deduction_day')) has-error @endif">
          <label for="name" class="control-label">Early Out Deduction </label> 
          <input type="number" class="form-control" id="early_out_deduction_day" name="early_out_deduction_day" placeholder="Number of days to be deducted" value="{{$attendance_deduction->early_out_deduction_day}}" > 
          @if ($errors->has('early_out_deduction_day')) <p class="help-block">{{ $errors->first('early_out_deduction_day') }}</p> @endif                             
        </div>
      </div> 

      <div class="col-md-2"> 
        <div class="form-group @if ($errors->has('early_out_deduction_valid')) has-error @endif">
          <label for="name" class="control-label">Valid </label> 
          <div class="checkbox">
            @if($attendance_deduction->early_out_deduction_valid==1)
            <label><input type="checkbox" class="minimal" name="early_out_deduction_valid" id="late_entry_deduction_valid" value="1" checked=""></label>
            @else
            <label><input type="checkbox" class="minimal" name="early_out_deduction_valid" id="late_entry_deduction_valid" value="1" ></label>
            @endif


          </div>
          @if ($errors->has('early_out_deduction_valid')) <p class="help-block">{{ $errors->first('early_out_deduction_valid') }}</p> @endif                             
        </div>
      </div> 

    </div> <!-- /.box-body --> 

    <div class="box-footer"> 
      <button type="submit" id="btn-submit" class="btn btn-primary pull-left">Submit</button>
    </div>
    <!-- /.box-footer -->
  </div><!-- /.box -->








</div><!-- /col-md-12 -->

{!! Form::close() !!} 



</div>  <!--row-->
</section>
<!-- /.content -->



@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>  
<script src="{{asset('bower_components/AdminLTE')}}/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/icheck.min.js"></script>
<script>

  $(document).ready(function () {





    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#attendance_deduction_form').validate({
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
        deduction_policy_name: {required: true},
        late_entry_day_count: { digits: true},
        late_entry_deduction_day: { digits: true},
        early_out_day_count: { digits: true},
        early_out_deduction_day: { digits: true},
      },
      messages: {
        deduction_policy_name: {required: "Please give name"}, 
        late_entry_day_count: {required: "Digits Only"}, 
        late_entry_deduction_day: {required: "Digits Only"}, 
        early_out_day_count: {required: "Digits Only"}, 
        early_out_deduction_day: {required: "Digits Only"}, 
      }
    });

//initialize timepicker on start_from 
$('#late_entry_time').timepicker({  
 showInputs: false
});

$('#early_out_time').timepicker({  
 showInputs: false
});

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

});//document ready



</script>


@endsection
