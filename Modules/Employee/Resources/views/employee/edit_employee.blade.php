@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> 
<link rel="stylesheet" href="{{asset('css/employee_tab_style.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">

<style>
  .select2-container--default {
    width: 100% !important;
  } 
  .paginate_button{
    padding: 0px !important;
  } 
</style>
@endsection
@section('page_header')
Employee
@endsection
@section('page_description')
Edit Employee
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

    <form action="" name="add_employe_form" id="add_employe_form" enctype="multipart/form-data" method="post">

      <input name="_method" type="hidden" value="PUT">
        {!! Form::hidden('id', $employee->id) !!}  
      <div class="col-md-12"> 
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create Employee</h3>
            <button type="button" id="btn-submit" class="btn btn-primary pull-right">Submit</button>
          </div>

          <div class="box-body">
            <div class="container-fluid">
              <div class="row">

                <div class="alert alert-danger alert-dismissible" id="table-remarks">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                  <span class="alert_message"></span>
                </div>

                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#personal_info">Personal Info</a></li>
                  <li><a data-toggle="tab" href="#job_info">Job Info</a></li>
                  <li><a data-toggle="tab" href="#salary_info">Salary Info</a></li>
                  <li><a data-toggle="tab" href="#salary_details">Salary Details</a></li>
                  <li><a data-toggle="tab" href="#educational_background">Educations</a></li>
                  <li><a data-toggle="tab" href="#previous_work_history">Previous Work History</a></li>
                  <li><a data-toggle="tab" href="#history_inside_organization">History Inside Organization</a></li>
                  <li><a data-toggle="tab" href="#family_information">Family Info</a></li>
                </ul>

                <div class="tab-content">

                  <div id="personal_info" class="tab-pane fade in active">
                    <div class="bhoechie-tab-content">
                     @include('employee::employee.edit_employees_personal_details_sub_view')
                   </div> 
                 </div>

                 <div id="job_info" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.edit_employees_job_info_sub_view')
                  </div> 
                </div>
                
                <div id="salary_info" class="tab-pane fade">
                  <div class="bhoechie-tab-content"> 
                    @include('employee::employee.edit_employees_salary_info_sub_view')
                  </div>
                </div>

                <div id="salary_details" class="tab-pane fade">
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employee_salary_details_sub_view')
                  </div>
                </div>
                <div id="educational_background" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employee_educational_background')
                  </div>
                </div>
                <div id="previous_work_history" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employee_previous_work_history')
                  </div>
                </div>
                <div id="history_inside_organization" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employee_history_inside_organization')
                  </div>
                </div>
                <div id="family_information" class="tab-pane fade"> 
                  <div class="bhoechie-tab-content">
                    @include('employee::employee.employee_family_information')
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

<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>        
<script src="{{asset('js/utils/utils.js')}}"></script>


<!-- the following js file contains the jquery code to validate the entire form -->
<script src="{{asset('js/employee_validation.js')}}"></script>




<script>
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#bio").wysihtml5();
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
  $('#final_leave_encashed_date').datepicker();


  var department_branch_id=$('#department_branch_id'); 

$.get( "{{URL::to('/employee_job_info/auto/department_branch_id')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
  init_select2_with_default_value({
    default_value: data,
    placeholder: "Branch",
    url: '{{URL::to("/")}}/branch/auto/get_branchs',
    selector_id:department_branch_id,
    data:{}
  });
});



var department_id=$("#department_id");

$.get( "{{URL::to('/employee_job_info/auto/department')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
  init_select2_with_default_value({
    default_value: data,
    placeholder: "Department",
    url: '{{URL::to("/")}}/branch/auto/get_departments',
    selector_id:department_id,
    data:{}
  });
});

  var designation_id=$('#designation_id'); 
  $.get( "{{URL::to('/employee_job_info/auto/designation')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Designation",
      url: '{{URL::to("/")}}/branch/auto/get_designations',
      selector_id:designation_id,
      data:{}
    });
  });


  var work_shift_id=$('#work_shift_id'); 
  $.get( "{{URL::to('/employee_job_info/auto/work_shift')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Work Shift",
      url: '{{URL::to("/")}}/branch/auto/get_work_shifts',
      selector_id:work_shift_id,
      data:{}
    });
  });
  
  var leave_package_id=$('#leave_package_id'); 
  $.get( "{{URL::to('/employee_job_info/auto/leave_package')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}}} ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Leave Package",
      url: '{{URL::to("/")}}/leave_package/auto/get_leave_packages',
      selector_id:leave_package_id,
      data:{}
    });
  });


  var attendance_deduction_master_id=$('#attendance_deduction_master_id'); 
  $.get( "{{URL::to('/employee_job_info/auto/attendance_deduction')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}}} ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Attendance Deduction Policy",
      url: '{{URL::to("/")}}/attendance_deduction/auto/get_attendance_deduction_policies',
      selector_id:attendance_deduction_master_id, 
      data:{}
    });
  });
  


  var holiday_list_id=$('#holiday_list_id'); 

  $.get( "{{URL::to('/employee_job_info/auto/holiday_list')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Holiday",
      url: '{{URL::to("/")}}/holiday/auto/get_holiday_lists',
      selector_id:holiday_list_id,
      data:{}
    });
  });


  var week_holiday_master_id=$('#week_holiday_master_id'); 


  $.get( "{{URL::to('/employee_job_info/auto/week_holiday')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Week Holiday",
      url: '{{URL::to("/")}}/week_holiday/auto/get_week_holiday_masters',
      selector_id:week_holiday_master_id,
      data:{}
    });
  });


  var salary_grade_master_id=$('#salary_grade_master_id'); 

  $.get( "{{URL::to('/employee_salary_info/auto/salary_grade')}}", { employee_salary_info: {{$employee->employee_job_info[0]->employee_salary_information[0]->id}} } ,function( data ) {
    init_select2_with_default_value({
      default_value: data,
      placeholder: "Salary Grade",
      url: '{{URL::to("/")}}/salary_grade/auto/get_salary_grades',
      selector_id:salary_grade_master_id,
      data:{}
    });
  });


});




$(document).ready(function () {

  $('#department_branch_id').change(function(){   
    $('#department_id').select2("val"," ");      
  });

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


var salary_details_table=$('#salary_details_table').DataTable();

//get data and render table for salary details
function InitializeSalaryDetailsTable(){
  $.ajax("{{URL::to('/employee/salary_heads_with_amount')}}", { 
    data: {
      // format: []
      "employee_salary_info_id":{{$employee->employee_job_info[0]->employee_salary_information[0]->id}}
    },
    async: "false",
    error: function() { 
    },type: 'GET',
    success: function(data) {  
    //as we are using the same link fore datatable in salary head
    //so we will find the data in data.data  
    // console.log(data[0]);
    $.each(data, function(index,item) {  
      // console.log(item);
      // InitializeSalaryDetailsTable(value);
      var arr=[]; 
      arr.push("<span>"+item.salary_head_name+"</span>"+"<input type='hidden' name='salary_head_id' class='salary_head_id' value='"+item.id+"'/>");
      arr.push("<span>"+item.type_name+"</span>"+"<input type='hidden' name='salary_head_id' class='salary_head_id' value='"+item.id+"'/>");
      var salary_amount=0;

      if (item.head_type==1) {
        arr.push("<span>Addition</span>");
      }else{
        arr.push("<span>Deduction</span>");
      }
      arr.push("<input class='form-control amount' name='amount[]' id='amount[]' type='number' min='0' value='"+item.amount+"' >");
      salary_details_table.row.add(arr).draw( false );


    })
  }
})
}

//initializing the table in the salary details tab with all the available salary heads
InitializeSalaryDetailsTable();

$('#salary_grade_master_id').change(function(){
  $('#basic_salary').val("");
  salary_details_table.clear().draw();
  InitializeSalaryDetailsTable();      
  if($(this).val()!=null){
  //change basic salary
  $.ajax("{{URL::to('/salary_grade/basic_salary_of_grade/')}}/"+$(this).val(), {
    data: {
      format: 'json'
    },
    error: function() { 
    },type: 'GET',
    success: function(data) {  
      $('#basic_salary').val(data[0].basic_salary); 
    }
  });
  //change salary heads in salary details based on salary grade
  changeSalaryHeadValueBasedOnSalaryGrade($(this).val());
}
});

function changeSalaryHeadValueBasedOnSalaryGrade(id){
  $.ajax("{{URL::to('/salary_grade/salary_grade_info/')}}/"+id, {
    data: {
      format: 'json'
    },
    error: function() { 
    },type: 'GET',
    success: function(data) { 
      $.each(data, function(index,item) { 
        replaceSalaryDetailsValue(item);
      });
    }
  });
}

function replaceSalaryDetailsValue(item){
  $('#salary_details_table > tbody  > tr').each(function() {
    if($(this).find(".salary_head_id").val()==item.salary_head_id){ 
      if(item.amount_type==1){ 
        $(this).find(".amount").val(item.amount);
      }else{
        var basic_salary=$('#basic_salary').val();
        if(basic_salary!="" && basic_salary!=0 && item.amount!=0){
          $(this).find(".amount").val((item.amount/100)*basic_salary);
        }
      }
    }

  });
}





var educational_background_table=$('#educational_background_table').DataTable();
  //initialize educational background table with previous value

  $.ajax("{{URL::to('employee/get_employee_educations')}}", {
    data: {
      "employees_master_id": {{$employee->id}}
    },
    async: "false",
    error: function() { 
    },type: 'GET',
    success: function(data) {  

      $.each(data, function(index,item) {   
        var arr=[]; 
        arr.push('<input class="form-control degree_name" type="text" placeholder="Degree Name" value="'+item.degree_name+'">');
        arr.push('<input class="form-control institution" type="text"  placeholder="Institution" value="'+item.institution+'">');
        arr.push('<input class="form-control passing_year" type="number"  placeholder="Passing Year" value="'+item.passing_year+'">'); 
        arr.push('<button class="btn btn-xs btn-danger pull-left deleteEducationalBackgroundButton" >Delete Row</button>'); 
        educational_background_table.row.add(arr).draw( false );

      })
    }
  })

    //add row
    $('#add_education_row').on( 'click', function (e) {
      e.preventDefault();
      renderEducationalBackgroundTable(); 
    });

    $('body').on('click', '.deleteEducationalBackgroundButton', function(e) {
      var tr=$(this).parents("tr");
      educational_background_table.row(tr).remove().draw(false);  
    }); 

    function renderEducationalBackgroundTable(){
      var arr=[]; 
      arr.push('<input class="form-control degree_name" type="text" placeholder="Degree Name">');
      arr.push('<input class="form-control institution" type="text"  placeholder="Institution">');
      arr.push('<input class="form-control passing_year" type="number"  placeholder="Passing Year">'); 
      arr.push('<button class="btn btn-xs btn-danger pull-left deleteEducationalBackgroundButton" >Delete Row</button>'); 
      educational_background_table.row.add(arr).draw( false );
    }    


//previous work history 
var previous_work_history_table=$('#previous_work_history_table').DataTable();

  //initialize previous work history  table with previous value
  
  $.ajax("{{URL::to('employee/previous_work_history')}}", {
    data: {
      "employees_master_id": {{$employee->id}}
    },
    async: "false",
    error: function() { 
    },type: 'GET',
    success: function(data) {  

      $.each(data, function(index,item) {   

        var arr=[]; 
        arr.push('<input class="form-control institution" type="text" placeholder="Organization" value="'+item.institution+'">');
        arr.push('<input class="form-control from_date" type="text"  placeholder="From Date" value="'+item.from_date+'">');
        arr.push('<input class="form-control to_date" type="text"  placeholder="To Date" value="'+item.to_date+'">');
        arr.push('<input class="form-control designation" type="text"  placeholder="Designation" value="'+item.designation+'">'); 
        arr.push('<button class="btn btn-xs btn-danger pull-left deletePreviousHistoryButton" >Delete Row</button>'); 
        previous_work_history_table.row.add(arr).draw( false );
        var from_date=$('.from_date');
        var to_date=$('.to_date');
        from_date.datepicker();
        to_date.datepicker();

      })
    }
  })


    //add row
    $('#add_previous_history_row').on( 'click', function (e) {
      e.preventDefault();
      renderPreviousHistoryTable(); 
    });

    $('body').on('click', '.deletePreviousHistoryButton', function(e) {
      var tr=$(this).parents("tr");
      previous_work_history_table.row(tr).remove().draw(false);  
    }); 

    function renderPreviousHistoryTable(){
      var arr=[]; 
      arr.push('<input class="form-control institution" type="text" placeholder="Organization">');
      arr.push('<input class="form-control from_date" type="text"  placeholder="From Date">');
      arr.push('<input class="form-control to_date" type="text"  placeholder="To Date">');
      arr.push('<input class="form-control designation" type="text"  placeholder="Designation">'); 
      arr.push('<button class="btn btn-xs btn-danger pull-left deletePreviousHistoryButton" >Delete Row</button>'); 
      previous_work_history_table.row.add(arr).draw( false );
      var from_date=$('.from_date');
      var to_date=$('.to_date');
      from_date.datepicker();
      to_date.datepicker();
    }    



//work history inside organization
var work_history_inside_organization_table=$('#history_inside_organization_table').DataTable();
var selector_counter=1;
    //add row
      //initialize work history inside Company table with previous value

      $.ajax("{{URL::to('employee/history_inside_organization')}}", {
        data: {
          "employees_master_id": {{$employee->id}}
        },
        async: "false",
        error: function() { 
        },type: 'GET',
        success: function(data) {  

          $.each(data, function(index,item) {   

            var arr=[]; 
            arr.push('<div><select id="department_branch_id_'+selector_counter+'" class="department_branch_id form-control table-form"></select></div>');
            arr.push('<div><select id="department_id_'+selector_counter+'"  class="department_id form-control table-form"></select></div>');
            arr.push('<div><select id="designation_id_'+selector_counter+'" class="designation_id form-control table-form"></select></div>'); 
            arr.push('<input class="form-control date" type="text"  placeholder="Date" value="'+item.date+'" >'); 
            arr.push('<input class="form-control remarks" type="text"  placeholder="Remarks" value="'+item.remarks+'">'); 
            arr.push('<button class="btn btn-xs btn-danger pull-left deleteHistoryInsideOrganisationButton" >Delete Row</button>'); 


            work_history_inside_organization_table.row.add(arr).draw( false );

            var table_department_branch_id=$('#department_branch_id_'+selector_counter);  

            $.get( "{{URL::to('/employee_job_info/auto/department_branch_id')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
              init_select2_with_default_value({
                default_value: data,
                placeholder: "Branch",
                url: '{{URL::to("/")}}/branch/auto/get_branchs',
                selector_id:table_department_branch_id,
                data:{}
              });
            });



            var table_department_id=$("#department_id_"+selector_counter);
            $.get( "{{URL::to('/employee_job_info/auto/department')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
              init_select2_with_default_value({
                default_value: data,
                placeholder: "Department",
                url: '{{URL::to("/")}}/branch/auto/get_departments',
                selector_id:table_department_id,
                data:{}
              });
            });



            var table_designation_id=$('.designation_id'); 

            $.get( "{{URL::to('/employee_job_info/auto/designation')}}", { employee_job_info: {{$employee->employee_job_info[0]->id}} } ,function( data ) {
              init_select2_with_default_value({
                default_value: data,
                placeholder: "Designation",
                url: '{{URL::to("/")}}/branch/auto/get_designations',
                selector_id:table_designation_id,
                data:{}
              });
            });

            var date=$('.date'); 
            date.datepicker(); 

            $('#department_branch_id_'+selector_counter).change(function(){   
              table_department_id.select2("val"," ");      
            });

            selector_counter++;

          })
        }
      })

      $('#add_history_inside_company_row').on( 'click', function (e) {
        e.preventDefault();
        renderHistoryInsideOrganizationTable(); 
      });

      $('body').on('click', '.deleteHistoryInsideOrganisationButton', function(e) {
        var tr=$(this).parents("tr");
        work_history_inside_organization_table.row(tr).remove().draw(false);  
      }); 

      function renderHistoryInsideOrganizationTable(){

        var arr=[]; 
        arr.push('<div><select id="department_branch_id_'+selector_counter+'" class="department_branch_id form-control table-form"></select></div>');
        arr.push('<div><select id="department_id_'+selector_counter+'"  class="department_id form-control table-form"></select></div>');
        arr.push('<div><select id="designation_id_'+selector_counter+'" class="designation_id form-control table-form"></select></div>'); 
        arr.push('<input class="form-control date" type="text"  placeholder="Date">'); 
        arr.push('<input class="form-control remarks" type="text"  placeholder="Remarks">'); 
        arr.push('<button class="btn btn-xs btn-danger pull-left deleteHistoryInsideOrganisationButton" >Delete Row</button>'); 


        work_history_inside_organization_table.row.add(arr).draw( false );



        var table_department_branch_id=$('#department_branch_id_'+selector_counter); 
        parameters = { 
          placeholder: "Job Branch",
          url: '{{URL::to("/")}}/branch/auto/get_branchs',
          selector_id:table_department_branch_id, 
          data:{}
        }

        init_select2(parameters);

        var table_department_id=$("#department_id_"+selector_counter);
        parameters = {
          placeholder: "Post Office",
          url: '{{URL::to("/")}}/branch/auto/get_departments',
          selector_id:table_department_id,
          value_id:$('#department_branch_id_'+selector_counter)
        }
        var date=$('.date'); 
        date.datepicker();
  // initialize select2 for post_office_id
  init_select2_with_one_parameter(parameters);

  var table_designation_id=$('.designation_id'); 
  parameters = { 
    placeholder: "Job Applicant",
    url: '{{URL::to("/")}}/designation/auto/get_designations',
    selector_id:table_designation_id, 
    data:{}
  }

  init_select2(parameters);

  $('#department_branch_id_'+selector_counter).change(function(){   
    table_department_id.select2("val"," ");      
  });


  selector_counter++;
}    






var family_relation_select2_counter=1;

var family_information_table=$('#family_information_table').DataTable();


      // initialize family relation table with previous values
      $.ajax("{{URL::to('employee/family_information')}}", {
        data: {
          "employees_master_id": {{$employee->id}}
        },
        async: "false",
        error: function() { 
        },type: 'GET',
        success: function(data) {  

          $.each(data, function(index,item) {   

            var arr=[]; 
            arr.push('<input class="form-control family_member_name" type="text" placeholder="Family Member Name" value="'+item.family_member_name+'">');
            arr.push('<input class="form-control date_of_birth" type="text"  placeholder="Date Of Birth" value="'+item.date_of_birth+'">');
            arr.push('<div><select id="family_relation_id_'+family_relation_select2_counter+'" class="family_relation_id form-control table-form"></select></div>'); 
            arr.push('<button class="btn btn-xs btn-danger pull-left deleteFamilyInformationButton" >Delete Row</button>'); 

            family_information_table.row.add(arr).draw( false );

            $('.date_of_birth').datepicker();

            var family_relation_id=$('#family_relation_id_'+family_relation_select2_counter); 


            $.get( "{{URL::to('/employee_family_information/auto/family_relation')}}", { employee_family_members_id: item.id } ,function( data ) {

              init_select2_with_default_value({
                default_value: data,
                placeholder: "Family Relation",
                url: '{{URL::to("/")}}/family_relation/auto/get_all_relations',
                selector_id:family_relation_id,
                data:{}
              });
            });            

            family_relation_select2_counter++;
          })
        }
      })

    //add row
    $('#add_family_information_row').on( 'click', function (e) {
      e.preventDefault();
      renderFamilyInformationTable(); 
    });

    $('body').on('click', '.deleteFamilyInformationButton', function(e) {
      var tr=$(this).parents("tr");
      family_information_table.row(tr).remove().draw(false);  
    }); 

    function renderFamilyInformationTable(){

      var arr=[]; 
      arr.push('<input class="form-control family_member_name" type="text" placeholder="Family Member Name">');
      arr.push('<input class="form-control date_of_birth" type="text"  placeholder="Date Of Birth">');
      arr.push('<div><select id="family_relation_id_'+family_relation_select2_counter+'" class="family_relation_id form-control table-form"></select></div>'); 
      arr.push('<button class="btn btn-xs btn-danger pull-left deleteFamilyInformationButton" >Delete Row</button>'); 

      family_information_table.row.add(arr).draw( false );

      $('.date_of_birth').datepicker();

      var family_relation_id=$('#family_relation_id_'+family_relation_select2_counter); 

      parameters = { 
        placeholder: "Relation",
        url: '{{URL::to("/")}}/family_relation/auto/get_all_relations',
        selector_id:family_relation_id, 
        data:{}
      }
      init_select2(parameters);
      family_relation_select2_counter++;
    }    
});//document ready


previewImage = function(event) {
  var output = document.getElementById('employee_image_preview');
  output.src = URL.createObjectURL(event.target.files[0]);
};

</script>


<script>
  // this script block is used to validate the form 

  function validateAllTableData(){
    var returnMessage=[true,'validation complete'];

    //first validating the educational background table
    //if any input is wrong then it will return false message
    $('#educational_background_table > tbody  > tr').each(function() {      
      if($(this).find(".degree_name").val()!=undefined){ 
        if ($(this).find(".degree_name").val()=="" || $(this).find(".institution").val()=="" ||$(this).find(".passing_year").val()=="" ) {
          return returnMessage=[false,'The Educational Table form is incomplete. Check if you missed giving any input.'];
        } 
      }
    }); 
    

    //if educatinal table is ok then we will check previous information table
    //if any input is wrong then it will return false message
    $('#previous_work_history_table > tbody  > tr').each(function() {   
      if($(this).find(".institution").val()!=undefined){      
        if ($(this).find(".institution").val()=="" || $(this).find(".designation").val()=="" ) {
          return returnMessage=[false,'The Previous History Table form is incomplete. Check if you missed giving any input.'];
        } 
      }
    }); 

    //if previous  infomation table is ok then we will check history inside organization information table
    //if any input is wrong then it will return false message
    $('#history_inside_organization_table > tbody  > tr').each(function() {   
      if($(this).find(".remarks").val()!=undefined){      
        if ($(this).find(".department_branch_id").val()==null || $(this).find(".designation_id").val()==null  || $(this).find(".department_id").val()==null  || $(this).find(".remarks").val()=="" || $(this).find(".date").val()=="" ) {
          return returnMessage=[false,'The History Inside Organization Table form is incomplete. Check if you missed giving any input.'];
        } 
      }
    }); 


    //if history inside infomation table is ok then we will check family information table
    //if any input is wrong then it will return false message
    $('#family_information_table > tbody  > tr').each(function() {   
      if($(this).find(".family_member_name").val()!=undefined){      
        if ($(this).find(".family_member_name").val()=="" || $(this).find(".date_of_birth").val()==""  || $(this).find(".family_relation_id").val()==null  || $(this).find(".remarks").val()=="" ) {
          return returnMessage=[false,'The Family Information Table form is incomplete. Check if you missed giving any input.'];
        } 
      }
    }); 



    return returnMessage;
  }

  function generateJsonObjectWithForm(){

    var formData = new FormData($("#add_employe_form")[0]);

    formData.append('salary_details',generateJsonStringFromTables('salary_details_table'));
    formData.append('educational_background',generateJsonStringFromTables('educational_background_table'));
    formData.append('history_inside_organization',generateJsonStringFromTables('history_inside_organization_table'));
    formData.append('family_information',generateJsonStringFromTables('family_information_table'));
    formData.append('previous_work_history',generateJsonStringFromTables('previous_work_history_table'));
    
    return formData;
  }

  function generateJsonStringFromTables(table_name){
    var jsonObj=[];
    var item;

    if(table_name=="salary_details_table"){
      $('#salary_details_table > tbody  > tr').each(function() {
        if ($(this).find(".salary_head_id").val()==undefined || $(this).find(".salary_head_id").val()==null) {
          return;
        }else{
          item={};
          item["salary_head_id"]=$(this).find(".salary_head_id").val(); 
          item["amount"]=$(this).find(".amount").val();
          jsonObj.push(item);
        } 
      });
    }else if(table_name=="educational_background_table"){
      $('#educational_background_table > tbody  > tr').each(function() {
        if ($(this).find(".degree_name").val()==undefined || $(this).find(".degree_name").val()==null) {
          return;
        }else{
          item={};
          item["degree_name"]=$(this).find(".degree_name").val(); 
          item["institution"]=$(this).find(".institution").val(); 
          item["passing_year"]=$(this).find(".passing_year").val();  
          jsonObj.push(item);
        }  

      });
      
    }else if(table_name=="previous_work_history_table"){
      $('#previous_work_history_table > tbody  > tr').each(function() {


        if ($(this).find(".institution").val()==undefined || $(this).find(".institution").val()==null) {
          return;
        }else{
          item={}; 
          item["institution"]=$(this).find(".institution").val(); 
          item["from_date"]=$(this).find(".from_date").val(); 
          item["to_date"]=$(this).find(".to_date").val(); 
          item["designation"]=$(this).find(".designation").val();    
          jsonObj.push(item);
        } 

      });
    }else if(table_name=="history_inside_organization_table"){

      $('#history_inside_organization_table > tbody  > tr').each(function() {

        if ($(this).find(".department_branch_id").val()==undefined || $(this).find(".department_branch_id").val()==null) {
          return;
        }else{
          item={}; 
          item["department_branch_id"]=$(this).find(".department_branch_id").val(); 
          item["department_id"]=$(this).find(".department_id").val(); 
          item["designation_id"]=$(this).find(".designation_id").val(); 
          item["remarks"]=$(this).find(".remarks").val();    
          jsonObj.push(item);
        } 


      });
    }else{
      $('#family_information_table > tbody  > tr').each(function() {
        if ($(this).find(".family_member_name").val()==undefined || $(this).find(".family_member_name").val()==null) {
          return;
        }else{
          item={}; 
          item["family_member_name"]=$(this).find(".family_member_name").val(); 
          item["date_of_birth"]=$(this).find(".date_of_birth").val(); 
          item["family_relation_id"]=$(this).find(".family_relation_id").val();  
          jsonObj.push(item);
        } 

      });
    }


    jsonObj=JSON.stringify(jsonObj);
    return jsonObj;
  }

  $(document).ready(function(){
    $('#btn-submit').on('click',function(e){
      alert("jk");
      
      if(!$('#add_employe_form').valid()){ 
        // alert("hjk");
        return;
      }   
console.log("sakd");
      // var validation_result=validateAllTableData();
      // if(validation_result[0]==false){
      //   $("#table-remarks .alert_message").html(validation_result[1]);
      //   $("#table-remarks").css("display","block").delay(10000).fadeOut(400);
      //   return;
      // }
      //if everything alright then post the form data
      postAllData();
    });//button-submit on click


    function postAllData(){
      //for csrf check
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      
      var formData=generateJsonObjectWithForm(); 

      console.log(formData);

      $.ajax({
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,  
        dataType: "JSON",  
        url: "{{URL::to('/employee/'.$employee->id)}}", 
        // url: "{{URL::to('/employee')}}", 
        success:function(data){     
          if(data.error!=undefined){ 
            alert("jipl");
            $("#table-remarks .alert_message").html(data.error);  
            $("#table-remarks").css("display","block").delay(10000).fadeOut(400);
          }else{ 
           window.location.replace(data.redirect); 
         }
       }, 
       error: function(data){ 

            // if backend validation fails then the errors will be shown
            var errors = data.responseJSON;
            var errorsHtml="";
          // console.log(errors);
          // Render the errors with js ...

          $.each( errors, function( key, value ) {
            errorsHtml += '<li>' + value[0] + '</li>';  
          });
          $("#table-remarks .alert_message").html(""); 
          $("#table-remarks .alert_message").html("<ul>"+errorsHtml+"</ul>");  
          $("#table-remarks").css("display","block").delay(10000).fadeOut(400);

        }        
      });
    }
  }); //document ready
</script>

@endsection