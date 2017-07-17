@extends('layouts.master')
@section('css')  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
@endsection
@section('page_header')
Leave Record
@endsection
@section('page_description')
Manage Leave Record
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('leave_stock') !!}
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
        <div class="box-body"> 
          <form id="leave_stock_form"> 
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
        </form>
        <div class="box-footer"> 
          <!-- <button  id="btn-find-record" class="btn btn-primary pull-left">Find Record</button> -->
        </div> <!-- /.box-footer -->        
      </div>
    </div>


    <!--  Permission List-->
    <div class="col-lg-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Employee Leave Record</h3>
          <button type="button" id="btn-submit" class="btn btn-primary pull-right" style="display: none">Update Record</button>
        </div>

        <div class="box-body"> 
          <table id="all_role_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Leave Type Name</th>  
                <th>Number Of Days</th>  
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
<script src="{{asset('bower_components/AdminLTE/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

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
    $('form input, select, textarea').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#leave_stock_form').validate({
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
      },
      messages: {   
        employees_master_id: {required: "Please give Employee"},
      }
    });





    var table = $('#all_role_table').DataTable();
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
      $('#btn-submit').css('display','block');   
    });

    employees_master_id.on("select2:unselect", function(evt) {
     $('#employee_fullname').val("");    
     $('#contact_number').val("");
     $('#btn-submit').css('display','none');
   });


    employees_master_id.on('change',function(){ 
      if ($('#employees_master_id').val()==null) {
       table.clear();   
       table=$('#all_role_table').DataTable({"destroy":true});
       return;
     }
    // alert("asdka");
    table.destroy();

    //Datatable Generation

    table=$('#all_role_table').DataTable({
      "destroy":true,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "processing": true,
      "ajax": "{{URL::to('/leave_stock/get_leave_record')}}/"+$('#employees_master_id').val(),
      "columns": [  

      { 
        "data": "leave_type_name",
        "render": function ( data, type, full, meta ) { 
          return  data+"<input type='hidden'  class='leave_type_id' value='"+full.id+"' readonly>";
        }
      }, { 
        "data": "number_of_days",
        "render": function ( data, type, full, meta ) { 
          return  "<input type='number' class='form-control number_of_days' value='"+data+"'>";
        }
      }, 

      ],
      "order": [[0, 'asc']]
    });  
  });



    $('#btn-submit').on('click',function(){  
      if (!$('#leave_stock_form').valid()) {  
       return;
     } else{
      postAllData();
     }

   });




  function generateJsonObjectWithForm(){

    var formData = new FormData($("#leave_stock_form")[0]); 
 
    formData.append('data',generateJsonStringFromTables());
 
    return formData;
  }



  function generateJsonStringFromTables(){
    var jsonObj=[];
    var item;
 
      $('#all_role_table > tbody  > tr').each(function() { 
          item={}; 
          item["leave_type_id"]=$(this).find(".leave_type_id").val();
          if (($(this).find(".number_of_days").val()==null) || ($(this).find(".number_of_days").val()=="")) { 
            item["number_of_days"]=0; 
          } else{ 
            item["number_of_days"]=$(this).find(".number_of_days").val(); 
          }   
          jsonObj.push(item); 
      }); 


    jsonObj=JSON.stringify(jsonObj);
    return jsonObj;
  }




    function postAllData(){
      //for csrf check
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      
      var formData=generateJsonObjectWithForm(); 
      
      $.ajax({
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,  
        dataType: "JSON",  
        url: "{{URL::to('/leave_stock')}}", 
        success:function(data){    
          if(data.error!=undefined){  
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

});//document ready



</script>

@endsection
