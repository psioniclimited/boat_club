@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
@endsection
@section('page_header')
Holiday
@endsection
@section('page_description')
Set up Holiday
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('holiday') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Holiday Create</h3>
        </div>

        {!! Form::open(array('route'=>'holiday.store','id'=>'add_holiday_form','class' => 'form-horizontal')) !!}

        <div class="box-body">
          <div class="col-md-12"> 

            <div class="form-group @if ($errors->has('description')) has-error @endif">
              <label for="name" class="control-label">Holiday Name*</label> 
              <input type="text" class="form-control" id="description" name="description" placeholder="Enter name" value="{{old('description')}}" > 
              @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif                             
            </div>

            <div class="form-group @if ($errors->has('holiday_date')) has-error @endif">
              <label for="name" class="control-label">Holiday Date*</label> 
              <input type="text" class="form-control" id="holiday_date" name="holiday_date" placeholder="Enter Date" value="{{old('holiday_date')}}"  data-date-format='yyyy-mm-dd' > 
              @if ($errors->has('holiday_date')) <p class="help-block">{{ $errors->first('holiday_date') }}</p> @endif                             
            </div>
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer"> 
          <button type="submit" id="btn-submit" class="btn btn-primary pull-left">Submit</button>
        </div> <!-- /.box-footer -->
        {!! Form::close() !!} 
      </div><!-- /.box -->
    </div><!-- /col-md-6 -->
  </div>  <!--row-->
</section>
<!-- /.content -->



@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
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

    $('#add_holiday_form').validate({
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
        description: {required: true, minlength: 4}, 
        holiday_date: {required: true,date: true}
      },
      messages: {
        description: {required: "Please give name"},
        holiday_date: {required: "Please give a date"}
      }
    });

    $('#holiday_date').datepicker();
});//document ready



</script>

@endsection
