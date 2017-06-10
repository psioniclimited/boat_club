@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}">  

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<style>
  .col-md-6{
    padding-right: 20px !important;
  }
</style>
@endsection
@section('page_header')
Employee
@endsection
@section('page_description')
manage employee
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('employee') !!}
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
          <h3 class="box-title">Employee Transfer And Promotion</h3>
        </div>

        {!! Form::open(array('route'=>'employee_resignation.store','id'=>'employee_resignation_form','class' => 'form-horizontal')) !!}

        <div class="col-md-12">
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


        </div>

        <div class="row"></div>

        <div class="box-body">
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('resignation_offer_date')) has-error @endif">
              <label for="name" class="control-label">Resignation Offer Date*</label>
              <input class="form-control"  type="text" name="resignation_offer_date" id="resignation_offer_date" placeholder="Resignation Offer Date">              
              @if ($errors->has('resignation_offer_date')) <p class="help-block">{{ $errors->first('resignation_offer_date') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('relieving_date')) has-error @endif">
              <label for="name" class="control-label">Relieving Date*</label>
              <input class="form-control"  type="text" name="relieving_date" id="relieving_date" placeholder="Resignation Offer Date">              
              @if ($errors->has('relieving_date')) <p class="help-block">{{ $errors->first('relieving_date') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->
          <div class="col-md-12">  
            <div class="form-group @if ($errors->has('reason_for_leaving')) has-error @endif">
              <label for="name" class="control-label">Reason For Leaving</label>
              <textarea class="form-control" name="reason_for_leaving" id="reason_for_leaving" cols="60" rows="10" placeholder="Reason For Leaving"></textarea>

              @if ($errors->has('reason_for_leaving')) <p class="help-block">{{ $errors->first('reason_for_leaving') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <div class="col-md-12">  
            <div class="form-group @if ($errors->has('new_workplace')) has-error @endif">
              <label for="name" class="control-label">New Workplace</label>
              <input class="form-control"  type="text" name="new_workplace" id="new_workplace" placeholder="New Work Place">    
              @if ($errors->has('new_workplace')) <p class="help-block">{{ $errors->first('new_workplace') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->


          <div class="col-md-12">  
            <div class="form-group @if ($errors->has('feedback')) has-error @endif">
              <label for="name" class="control-label">Feedback</label>
              <textarea class="form-control" name="feedback" id="feedback" cols="60" rows="10" placeholder="Feedback"></textarea>

              @if ($errors->has('feedback')) <p class="help-block">{{ $errors->first('feedback') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->


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

<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>   
<script src="{{asset('js/utils/utils.js')}}"></script>

<script>

  $(document).ready(function () {

    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#employee_resignation_form').validate({
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
        resignation_offer_date: {required: true},
        relieving_date: {required: true},
        

      },
      messages: {  
        employees_master_id: {required: "Please select Employee"},
        resignation_offer_date: {required: "Please give Resignation Offer Date"},
        relieving_date: {required: "Please give Relieving Date"},
        

      }
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


    $('#resignation_offer_date').datepicker();
    $('#relieving_date').datepicker();
});//document ready



</script>

@endsection
