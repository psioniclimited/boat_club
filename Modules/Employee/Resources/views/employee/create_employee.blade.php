@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> 
<link rel="stylesheet" href="{{asset('css/employee_tab_style.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<style>
  .select2-container--default {
    width: 100% !important;
  }

</style>
@endsection
@section('page_header')
Employee
@endsection
@section('page_description')
Create Employee
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

    <form action="" name="add_employe_form" id="add_employe_form">
      <div class="col-md-12"> 
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create Employee</h3>
            <button type="submit" id="btn-submit" class="btn btn-primary pull-right">Submit</button>
          </div>

          <div class="box-body">
            <div class="container-fluid">
              <div class="row">


                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#personal_info">Personal Info</a></li>
                  <li><a data-toggle="tab" href="#job_info">Job Info</a></li>
                  <li><a data-toggle="tab" href="#salary_info">Salary Info</a></li>
                </ul>

                <div class="tab-content">

                  <div id="personal_info" class="tab-pane fade in active">
                    <div class="bhoechie-tab-content">
                     @include('employee::employee.employees_personal_details_sub_view')
                   </div> 
                 </div>

                 <div id="job_info" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employees_job_info_sub_view')
                  </div> 
                </div>
                
                <div id="salary_info" class="tab-pane fade">
                  <div class="bhoechie-tab-content"> 

                    <div class="col-md-6"> 
                      <div class="form-group @if ($errors->has('salary_grade_master_id')) has-error @endif">
                        <label for="name" class="control-label">Salary Grade*</label>
                        <select class="form-control" id="salary_grade_master_id" name="salary_grade_master_id" > 
                        </select>                 
                        @if ($errors->has('salary_grade_master_id')) <p class="help-block">{{ $errors->first('salary_grade_master_id') }}</p> @endif                             
                      </div> 
                    </div><!-- /.col-md-6 -->


                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('basic_salary')) has-error @endif">  
                        <label for="name" class="control-label">Basic Salary</label> 
                        <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Basic Salary" value="{{old('basic_salary')}}"> 
                        @if ($errors->has('basic_salary')) <p class="help-block">{{ $errors->first('basic_salary') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-12"></div>

                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('hourly_pay_rate')) has-error @endif">  
                        <label for="name" class="control-label">Hourly Pay Rate</label> 
                        <input type="number" class="form-control" id="hourly_pay_rate" name="hourly_pay_rate" placeholder="Hourly Pay Rate" value="{{old('hourly_pay_rate')}}"> 
                        @if ($errors->has('hourly_pay_rate')) <p class="help-block">{{ $errors->first('hourly_pay_rate') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->


                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('overtime_rate')) has-error @endif">  
                        <label for="name" class="control-label">OverTime Rate</label> 
                        <input type="number" class="form-control" id="overtime_rate" name="overtime_rate" placeholder="Overtime Pay Rate" value="{{old('overtime_rate')}}"> 
                        @if ($errors->has('overtime_rate')) <p class="help-block">{{ $errors->first('overtime_rate') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('weekly_overtime_hour_limit')) has-error @endif">  
                        <label for="name" class="control-label">Weekly Overtime Limit</label> 
                        <input type="number" class="form-control" id="weekly_overtime_hour_limit" name="weekly_overtime_hour_limit" placeholder="Overtime Limit (Hour)" value="{{old('weekly_overtime_hour_limit')}}"> 
                        @if ($errors->has('weekly_overtime_hour_limit')) <p class="help-block">{{ $errors->first('weekly_overtime_hour_limit') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->

                    <div class="col-md-12"></div>
                    <div class="col-md-6"> 
                      <div class="form-group @if ($errors->has('payment_mode_id')) has-error @endif">
                        <label for="name" class="control-label">Payment Mode*</label>
                        <select class="form-control" id="payment_mode_id" name="payment_mode_id" > 
                          <option value="1">Cash</option>
                          <option value="2">Bamk</option>
                        </select>                 
                        @if ($errors->has('payment_mode_id')) <p class="help-block">{{ $errors->first('payment_mode_id') }}</p> @endif                             
                      </div> 
                    </div><!-- /.col-md-6 -->
                    
                    <div class="col-md-12"></div>

                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('employee_bank_name')) has-error @endif">  
                        <label for="name" class="control-label">Employee's Bank Name</label> 
                        <input type="number" class="form-control" id="employee_bank_name" name="employee_bank_name" placeholder="Employee Bank Name" value="{{old('employee_bank_name')}}"> 
                        @if ($errors->has('employee_bank_name')) <p class="help-block">{{ $errors->first('employee_bank_name') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('employee_bank_branch')) has-error @endif">  
                        <label for="name" class="control-label">Employee's Bank Branch</label> 
                        <input type="number" class="form-control" id="employee_bank_branch" name="employee_bank_branch" placeholder="Employee's Bank Branch'" value="{{old('employee_bank_branch')}}"> 
                        @if ($errors->has('employee_bank_branch')) <p class="help-block">{{ $errors->first('employee_bank_branch') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-6">  
                      <div class="form-group @if ($errors->has('employee_bank_acc')) has-error @endif">  
                        <label for="name" class="control-label">Employee's Bank Account No.</label> 
                        <input type="number" class="form-control" id="employee_bank_acc" name="employee_bank_acc" placeholder="Employee's Bank Account'" value="{{old('employee_bank_acc')}}"> 
                        @if ($errors->has('employee_bank_acc')) <p class="help-block">{{ $errors->first('employee_bank_acc') }}</p> @endif                             
                      </div>
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-12"></div>
 
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div> <!-- /.box-body --> 


        <div class="box-footer"> 
          <!-- <button type="submit" id="btn-submit" class="btn btn-primary pull-left">Submit</button> -->
        </div> <!-- /.box-footer -->
      </form>
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

<script src="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>        
<script src="{{asset('js/utils/utils.js')}}"></script>
<script>

  $(document).ready(function () {
    $("#bio").wysihtml5();


    // initialize tooltipster on form input elements
    $('form input, select,textarea,file').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#add_employe_form').validate({
      highlight : function(label) {
        $(label).closest('.form-group').addClass('has-error');
        var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
        if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {                   
         $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
          var id = $(tab).attr("id");
          $('a[href="#' + id + '"]').tab('show');
        });
       }
     },
     ignore: [],
      // errorPlacement: function (error, element) { 
      //   var lastError = $(element).data('lastError'),
      //   newError = $(error).text();

      //   $(element).data('lastError', newError);

      //   if (newError !== '' && newError !== lastError) {
      //     $(element).tooltipster('content', newError);
      //     $(element).tooltipster('show');
      //   }
      // },
      success: function (label, element) {
        $(element).tooltipster('hide');
      },
      rules: {
        employee_code: {required: true,remote: '{{URL::to("/check_unique_employee_code")}}'},
        employee_fullname: {required: true},
        contact_number: {required: true},
        date_of_birth: {required: true},
        present_address: {required: true},
        permanent_address: {required: true}, 
        date_of_joining: {required: true}, 
        retirement_date: {required: true}, 
        department_branch_id: {required: true}, 
        department_id: {required: true}, 
        designation_id: {required: true}, 
        holiday_list_id: {required: true}, 
        week_holiday_master_id: {required: true}, 
      },
      messages: {
        employee_code: {required: "Please give Employee Code",remote: "Employee Code is in already use"},  
        employee_fullname: {required: "Please give Employee Name"},
        contact_number: {required: "Please give Employee's Contact Number"},
        date_of_birth: {required: "Please give Employee's Date Of Birth"},
        present_address : {required: "Please give Employee's Present Address"},
        permanent_address : {required: "Please give Employee's Permanent Address"}, 
        date_of_joining : {required: "Please give Employee's Joining Date"}, 
        retirement_date : {required: "Please give Employee's Retirement Date"}, 
        department_branch_id : {required: "Please give Employee's Branch Name"}, 
        department_branch_id : {required: "Please give Employee's Department Name"}, 
        department_branch_id : {required: "Please give Employee's Branch Name"}, 
        holiday_list_id : {required: "Please give Employee's Holiday List"}, 
        week_holiday_master_id : {required: "Please give Employee's Week Holiday"}, 
      }
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

    $('#date_of_birth').datepicker();
    $('#passport_issue_date').datepicker();
    $('#passport_valid_upto').datepicker();
    $('#offer_date').datepicker();
    $('#confirmation_date').datepicker();
    $('#date_of_joining').datepicker();
    $('#retirement_date').datepicker();
    $('#contract_end_date').datepicker();

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
$('#department_branch_id').change(function(){  
      // $(this).valid(); // trigger validation on this element
      $('#department_id').select2("val"," ");      
    });

var designation_id=$('#designation_id'); 
parameters = { 
  placeholder: "Job Applicant",
  url: '{{URL::to("/")}}/designation/auto/get_designations',
  selector_id:designation_id, 
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

var salary_grade_master_id=$('#salary_grade_master_id'); 
parameters = { 
  placeholder: "Salary Grade Holiday",
  url: '{{URL::to("/")}}/salary_grade/auto/get_salary_grades',
  selector_id:salary_grade_master_id, 
  data:{}
}

init_select2(parameters);



//on date of birth selection automatically sets the retirement date adding 60 years
$("#date_of_birth").change(function(){ 
  if ($(this).val()=="") {
    $("#retirement_date").val("");  
  }else{
    var birth_date=new Date($(this).val());
    var follow_date = new Date(birth_date.getFullYear() + 60,birth_date.getMonth(),birth_date.getDate());   
    $("#retirement_date").val(follow_date.getFullYear()  + '-' + (follow_date.getMonth()+1) + '-' +  follow_date.getDate());
  }
});

});//document ready

  // $(document).ready(function() {
  //   $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
  //     e.preventDefault();
  //     $(this).siblings('a.active').removeClass("active");
  //     $(this).addClass("active");
  //     var index = $(this).index();
  //     $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
  //     $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
  //   });
  // });
  //
  var previewImage = function(event) {
    var output = document.getElementById('employee_image_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

</script>

@endsection
