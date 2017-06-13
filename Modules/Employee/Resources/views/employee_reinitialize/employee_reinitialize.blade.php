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
        <h3 class="box-title">Employee Re Initialize</h3>
        </div>

        {!! Form::open(array('route'=>'employee_reinitialize.store','id'=>'employee_reinitiaze_form','class' => 'form-horizontal')) !!}
        <div class="box-body">
 
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

          <!-- <br> -->
          <div class="row"></div>

 
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('re_joining_date')) has-error @endif">
              <label for="name" class="control-label">Joining Date*</label>
              <input type="text" class="form-control" id="re_joining_date" name="re_joining_date" placeholder="Joining Date"> 
              @if ($errors->has('re_joining_date')) <p class="help-block">{{ $errors->first('re_joining_date') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  

            <div class="form-group @if ($errors->has('department_branch_id')) has-error @endif">
              <label for="name" class="control-label">Posting Branch*</label>
              <select class="form-control" id="department_branch_id" name="department_branch_id" > 
              </select>                 
              @if ($errors->has('department_branch_id')) <p class="help-block">{{ $errors->first('department_branch_id') }}</p> @endif                             
            </div>  

          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  

            <div class="form-group @if ($errors->has('department_id')) has-error @endif">
              <label for="name" class="control-label">Posting Department*</label>
              <select class="form-control" id="department_id" name="department_id" > 
              </select>                 
              @if ($errors->has('department_id')) <p class="help-block">{{ $errors->first('department_id') }}</p> @endif                             
            </div>  
            
          </div><!-- /.col-md-6 -->
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('designation_id')) has-error @endif">
              <label for="name" class="control-label">Designation*</label>
              <select class="form-control" id="designation_id" name="designation_id" > 
              </select>                 
              @if ($errors->has('designation_id')) <p class="help-block">{{ $errors->first('designation_id') }}</p> @endif                             
            </div>  
            
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('work_shift_id')) has-error @endif">
              <label for="name" class="control-label">Work Shift*</label>
              <select class="form-control" id="work_shift_id" name="work_shift_id" > 
              </select>                 
              @if ($errors->has('work_shift_id')) <p class="help-block">{{ $errors->first('work_shift_id') }}</p> @endif                             
            </div>  

          </div><!-- /.col-md-6 -->
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('holiday_list_id')) has-error @endif">
              <label for="name" class="control-label">Holiday List*</label>
              <select class="form-control" id="holiday_list_id" name="holiday_list_id" > 
              </select>                 
              @if ($errors->has('holiday_list_id')) <p class="help-block">{{ $errors->first('holiday_list_id') }}</p> @endif                             
            </div>  

          </div><!-- /.col-md-6 -->
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('week_holiday_master_id')) has-error @endif">
              <label for="name" class="control-label">Week Holiday*</label>
              <select class="form-control" id="week_holiday_master_id" name="week_holiday_master_id" > 
              </select>                 
              @if ($errors->has('week_holiday_master_id')) <p class="help-block">{{ $errors->first('week_holiday_master_id') }}</p> @endif                             
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

    $('#employee_reinitiaze_form').validate({
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
        department_branch_id: {required: true},
        department_id: {required: true},
        designation_id: {required: true},
        work_shift_id: {required: true},
        holiday_list_id: {required: true},
        week_holiday_master_id: {required: true},
        re_joining_date: {required: true},

      },
      messages: {   
        employees_master_id: {required: "Please give Employee"},
        department_branch_id: {required: "Please give Branch"},
        department_id: {required: "Please give Department"},
        designation_id: {required: "Please give Designation"},
        work_shift_id: {required: "Please give Work Shift"},
        holiday_list_id: {required: "Please give Holiday List"},
        week_holiday_master_id: {required: "Please give Week Holiday"},
        re_joining_date: {required: "Please give Week Holiday"},

      }
    });


    var employees_master_id=$('#employees_master_id'); 
    parameters = { 
      placeholder: "Employee",
      url: '{{URL::to("/")}}/employee/auto/get_resigned_employees',
      selector_id:employees_master_id, 
      data:{}
    }

    init_select2(parameters);

    var department_branch_id=$('#department_branch_id'); 
    parameters = { 
      placeholder: "Job Branch",
      url: '{{URL::to("/")}}/branch/auto/get_branchs',
      selector_id:department_branch_id, 
      data:{}
    }

    init_select2(parameters);

    var department_id=$("#department_id");
    parameters = {
      placeholder: "Post Office",
      url: '{{URL::to("/")}}/branch/auto/get_departments',
      selector_id:department_id,
      value_id:$('#department_branch_id')
    }

  // initialize select2 for post_office_id
  init_select2_with_one_parameter(parameters);

  var designation_id=$('#designation_id'); 
  parameters = { 
    placeholder: "Job Applicant",
    url: '{{URL::to("/")}}/designation/auto/get_designations',
    selector_id:designation_id, 
    data:{}
  }

  init_select2(parameters);

  var work_shift_id=$('#work_shift_id'); 
  parameters = { 
    placeholder: "Work Shift",
    url: '{{URL::to("/")}}/branch/auto/get_work_shifts',
    selector_id:work_shift_id, 
    data:{}
  }

  init_select2(parameters);


  var holiday_list_id=$('#holiday_list_id'); 
  parameters = { 
    placeholder: "Holiday List",
    url: '{{URL::to("/")}}/holiday/auto/get_holiday_lists',
    selector_id:holiday_list_id, 
    data:{}
  }

  init_select2(parameters);

  var week_holiday_master_id=$('#week_holiday_master_id'); 
  parameters = { 
    placeholder: "Week Holiday",
    url: '{{URL::to("/")}}/week_holiday/auto/get_week_holiday_masters',
    selector_id:week_holiday_master_id, 
    data:{}
  }

  init_select2(parameters);

  $('#department_branch_id').change(function(){   
    $('#department_id').select2("val"," ");      
  });


  employees_master_id.on("select2:select",function (e) { 
    $('#employee_fullname').val(employees_master_id.select2('data')[0]['employee_fullname']);    
    $('#contact_number').val(employees_master_id.select2('data')[0]['contact_number']);   
  });

  employees_master_id.on("select2:unselect", function(evt) {
   $('#employee_fullname').val("");    
   $('#contact_number').val("");
 });

$('#re_joining_date').datepicker();
});//document ready



</script>

@endsection
