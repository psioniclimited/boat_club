@extends('layouts.master')
@section('css')  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">  
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">

<style>
  img{
    margin-left: auto;
    margin-right:auto;
  }
</style>
@endsection
@section('page_header')
Attendance
@endsection
@section('page_description')
Attendance List
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

    <!--  Permission List-->
    <div class="col-lg-12">



      <div class="box box-info">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Attendance</h3> -->
        </div>

        <div class="box-body">  
          <form action="" method="GET" id="attendance_form">

           <div class="col-md-3"> 
            <div class="form-group @if ($errors->has('working_date')) has-error @endif">
              <label for="name" class="control-label">Date*</label> 
              <input type="text" class="form-control" id="working_date" name="working_date" placeholder="Enter Date" value="{{old('working_date')}}" > 
              @if ($errors->has('working_date')) <p class="help-block">{{ $errors->first('working_date') }}</p> @endif                             
            </div>
          </div>

          <div class="col-md-4">  
            <div class="form-group @if ($errors->has('department_branch_id')) has-error @endif">
              <label for="name" class="control-label">Posting Branch*</label>
              <select class="form-control" id="department_branch_id" name="department_branch_id" > 
              </select>                 
              @if ($errors->has('department_branch_id')) <p class="help-block">{{ $errors->first('department_branch_id') }}</p> @endif                             
            </div>  
          </div><!-- /.col-md-6 -->

          <div class="col-md-3">  
            <div class="form-group @if ($errors->has('department_id')) has-error @endif">
              <label for="name" class="control-label">Posting Department*</label>
              <select class="form-control" id="department_id" name="department_id" > 
              </select>                 
              @if ($errors->has('department_id')) <p class="help-block">{{ $errors->first('department_id') }}</p> @endif                             
            </div>  
          </div><!-- /.col-md-6 -->

          <div class="col-md-2">
            <div class="form-group"> 
              <br>
              <button type="button" id="submit_button" class="form-control btn btn-primary pull-left">Submit</button>                 
            </div> 
          </div> 
        </form>
      </div> 
    </div>


    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Attendance List</h3>
      </div>



      <div class="box-body"> 
        <table id="all_role_table" class="table table-bordered table-hover">
          <thead>
            <tr> 
              <th>Employee Name</th> 
              <th>Employee Code</th> 
              <th>Branch</th>  
              <th>Department</th>
              <th>Designation</th> 
              <th>Punch In</th> 
              <th>Punch Out</th>  
            </tr>
          </thead>
          <tbody>
          </tbody> 
        </table>
      </div>
    </div>




  </div>


</div>    
</section>
<!-- /.content -->



@endsection


@section('scripts')

<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>

<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>   
<script src="{{asset('js/utils/utils.js')}}"></script>

<script>

  $(document).ready(function () {

   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });   


    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'left'  // display the tips to the right of the element
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
        working_date: {required: true}, 
        department_branch_id: {required: true}, 
      },
      messages: { 
        working_date: {required: "Please Select Date"}, 
        department_branch_id: {required: "Please Select a Branch"}, 
      }
    });


     //Date picker
     $('#working_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });


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
      $('#department_id').select2("val"," ");      
    });

    var table=$('#all_role_table').DataTable({});




    function initializeTable(){

      table.destroy();

    //Datatable Generation
    table = $('#all_role_table').DataTable({
     "paging": true,
     "lengthChange": true,
     "searching": true,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "processing": true,
     "serverSide": true,
     // "ajax": "{{URL::to('/employee/get_all_employees')}}",
     "ajax": {
      type: "GET", 
      data: {
        "working_date":$('#working_date').val(),
        "department_branch_id":$('#department_branch_id').val(),
        "department_id":$('#department_id').val(), 
      },
      dataType: "JSON",  
      url: "{{URL::to('/get_attendance_list_table')}}", 
      success:function(data){     
        console.log(data);
      },       
    },
    "columns": [

    // // {"data": "employees_master.employee_fullname"}, 
    // // {"data": "employees_master.employee_code"}, 
    // // {"data": "employees_master.employee_job_info[0].department.branch.branch_name"}, 
    // // {"data": "employees_master.employee_job_info[0].department.department_name"},  
    // // {"data": "employees_master.employee_job_info[0].designation.designation_name"},  


    {"data": "employee_fullname"}, 
    {"data": "employee_code"}, 
    {"data": "branch_name"}, 
    {"data": "department_name"},  
    {"data": "designation_name"},  

    {"data": "punch_in_time"},  
    {"data": "punch_out_time"}, 

    ], 
    "order": [[0, 'asc']]
  });  
    


  }

  $('#submit_button').on('click',function(){ 
    if(!$('#attendance_form').valid()){ 
      return;
    }  else{
      initializeTable();
    } 
  });
  // initializeTable();


});//document ready



</script>

@endsection
