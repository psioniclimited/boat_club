@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">
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

        {!! Form::open(array('url' => URL::to("/attendance/bulk_attendance"))) !!}

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

          <div class="col-md-12" id="employee_panel"> 
            <div class="form-group ">
              <label for="name" class="control-label">Employees*</label> 
              <div class="checkbox" id="employees_id_checkbox"> 
              </div>                        
            </div>
          </div>
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
<script src="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/icheck.min.js"></script>
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



  $('#department_id,#attendance_type,#working_date,#department_branch_id').on('change',function(){
  // alert("here");
  updateEmployeeList();
});

  function updateEmployeeList(){
    // alert("there");
    $.ajax({
      type: "GET",
      // data: new FormData($("#attendance_form")[0]),
      data: {
        "working_date":$('#working_date').val(),
        "attendance_type":$('#attendance_type').val(),
        "department_id":$('#department_id').val(), 
      }, 
      dataType: "JSON",  
      url: "{{URL::to('/attendance/get_employees')}}", 
      success:function(data){    
        // console.log(data);



        $('#employees_id_checkbox').html('');
        $.each(data, function( index, value ) {


         console.log(value);
         if(($('#attendance_type').val()==1) && (value.punch_in_time==null)){
           $('#employees_id_checkbox').append('<label class="col-md-4"><input type="checkbox" class="minimal" name="employees_master_id[]" id="employees_master_id[]" value="'+value.id+'" >'+value.employee_code+" | "+value.employee_fullname+'</label>');
         }         

         if(($('#attendance_type').val()==1) && (value.punch_in_time!=null)){
           $('#employees_id_checkbox').append('<label class="col-md-4"><input type="checkbox" class="minimal"  disabled="disabled" checked >'+value.employee_code+" | "+value.employee_fullname+'</label>');
         }

         if(($('#attendance_type').val()==2) && (value.punch_out_time==null)){  
          $('#employees_id_checkbox').append('<label class="col-md-4"><input type="checkbox" class="minimal" name="employees_master_id[]" id="employees_master_id[]" value="'+value.id+'" >'+value.employee_code+" | "+value.employee_fullname+'</label> ');
        }

        if(($('#attendance_type').val()==2) && (value.punch_out_time!=null)){ 
         $('#employees_id_checkbox').append('<label class="col-md-4"><input  disabled="disabled" type="checkbox" class="minimal" checked >'+value.employee_code+" | "+value.employee_fullname+'</label>');
       }


     });


      }, 
      error: function(data){ 


          //   // if backend validation fails then the errors will be shown
          //   var errors = data.responseJSON;
          //   var errorsHtml="";
          // // console.log(errors);
          // // Render the errors with js ...

          // $.each( errors, function( key, value ) {
          //   errorsHtml += '<li>' + value[0] + '</li>';  
          // });
          // $("#table-remarks .alert_message").html(""); 
          // $("#table-remarks .alert_message").html("<ul>"+errorsHtml+"</ul>");  
          // $("#table-remarks").css("display","block").delay(10000).fadeOut(400);

        }        
      });
  }





});//document ready



</script>

@endsection
