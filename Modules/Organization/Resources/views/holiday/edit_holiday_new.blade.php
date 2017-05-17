@extends('layouts.master')
@section('css')  

<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
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
{{$holiday_list->holiday_list_name}}
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
          <h3 class="box-title">Holiday Details</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            <form action="" id="add_holiday_form">

              <div class="form-group @if ($errors->has('holiday_list_name')) has-error @endif">
                <label for="name" class="control-label">Holiday List Name*</label> 
                <input type="text" class="form-control" id="holiday_list_name" name="holiday_list_name" placeholder="Enter name" value="{{$holiday_list->holiday_list_name}}"> 
                @if ($errors->has('holiday_list_name')) <p class="help-block">{{ $errors->first('holiday_list_name') }}</p> @endif                             
              </div>

            </div>
          </form>          
          <!-- /.col -->
        </div>
        <!-- /.box-body -->
      </div>

      <div class="box box-info">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Salary Grade Details</h3> -->
          <button class="btn btn-xs btn-info pull-left" id="addRow">Add New Row</button>  
        </div>
        <div class="box-body"> 

          <div class="col-md-12"> 

            <div class="alert alert-danger alert-dismissible" id="table-remarks">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
              <span class="alert_message"></span>
            </div>


            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>  
                  <th>Name</th>
                  <th>Date</th> 
                  <th>Action</th> 
                </tr>
              </thead>
              <tfoot>
                <tr> 
                  <th>Name</th>
                  <th>Date</th> 
                  <th>Action</th> 
                </tr>
              </tfoot>
            </table>
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer"> 
          <button type="submit" id="btn_submit" class="btn btn-primary pull-left">Submit</button>
        </div> <!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /col-md-6 -->
  </div>  <!--row-->
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

<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });   
});//document ready



  $(document).ready(function () { 

    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    // initialize validate plugin on the form
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
        holiday_list_name: {required: true, minlength: 4}, 
      },
      messages: {
       holiday_list_name: {required: "Please give name"},
     }
   });
});//document ready









  $(document).ready(function() {
    var table = $('#example').DataTable(); 
    var readyToPost=0; //0 for error 1 for ready 

    $.ajax("{{URL::to('/holiday/details').'/'.$holiday_list->id}}", {
      data: {
        format: 'json'
      },
      error: function() { 
      },type: 'GET',
      success: function(data) { 
       $.each(data, function(i, item) { 
        renderTheTable(item,1); //first parameter for data second parameter for instruction
      });
     }
   });



    function renderTheTable(item,mode){ 
      var stringAr;

      if (mode==1) {  
        stringAr=arrayForTableGeneration(item.holiday_name,item.holiday_date); 
      }else{
        stringAr=arrayForTableGeneration(null,null); 
      }

      table.row.add(stringAr).draw( false );

      var holiday_date=$('.holiday_date');
      holiday_date.datepicker();


    }

    function arrayForTableGeneration(holiday_name,holiday_date){
      var arr=[]; 

      if(holiday_name!=null){
        arr.push('<input type="text"  class="holiday_name form-control" placeholder="Holiday Name"  value="'+holiday_name+'">');
      }else{
        arr.push('<input type="text" class="holiday_name form-control" placeholder="Holiday Name" value="">');
      }

      if(holiday_date!=null){
        arr.push('<input type="text"  class="holiday_date form-control" placeholder="Holiday Date"  value="'+holiday_date+'"  data-date-format="yyyy/mm/dd">');
      }else{
        arr.push('<input type="text"  class="holiday_date form-control" placeholder="Holiday Date"  value="" data-date-format="yyyy/mm/dd">');
      }


      arr.push('<button class="btn btn-xs btn-danger pull-left deleteButton" >Delete Row</button>');
      return arr;
    }


    //add row
    $('#addRow').on( 'click', function () {
         renderTheTable(null,2); //first parameter for data second parameter for instruction
       } );
    //delete row
    $('body').on('click', '.deleteButton', function(e) {
      var tr=$(this).parents("tr");
      table.row(tr).remove().draw(false);  
    }); 


    //submit
    $('body').on('click', '#btn_submit', function() {

      var validationResult=validateTableData(); 

      if (validationResult[0]==true) {
        postTableData();
        // alert("sds");
      }else{
        $("#table-remarks .alert_message").html(validationResult[1]);
        $("#table-remarks").css("display","block").delay(5000).fadeOut(400);
      }

    }); 


    function validateTableData(){

      var storedIds=[]; 

      var returnMessage=[true,'validation complete'];
      
      if (!$('#holiday_list_name').valid()) {
        returnMessage=[false,'Some Error Found'];
      }

      $('#example > tbody  > tr').each(function() {        
        if ($(this).find(".holiday_name").val()=="" || $(this).find(".holiday_date").val()=="") {
          return returnMessage=[false,'The form is incomplete. Check if you missed giving any input.'];
        }else{
          storedIds.push($(this).find(".holiday_date").val());
        } 
      }); 

      var normalarray_length=storedIds.length; 
      var uniqarray_length=$.unique(storedIds).length; 

      if (normalarray_length != uniqarray_length) {
        returnMessage=[false,'The form has repeated inputs. Check if you inserted two similar salary heads.'];
      }
      return returnMessage;
    }


    function postTableData(){ 
      var jsonObj=[];
      var item;
      $('#example > tbody  > tr').each(function() {
        item={};
        item["holiday_name"]=$(this).find(".holiday_name").val();
        item["holiday_date"]=$(this).find(".holiday_date").val();
        item["holiday_list_id"]={{$holiday_list->id}};
        jsonObj.push(item);
      });
      jsonObj=JSON.stringify(jsonObj);
      // console.log(jsonObj);
      
      $.ajax({
        type: "POST",
        data: {"holiday_list_id":{{$holiday_list->id}},
        "data":jsonObj,
        "holiday_list_name":$("#holiday_list_name").val()
      },
      url: "{{URL::to('/holiday/store_holiday_info')}}",
      success:function(data){ 
        window.location.reload();
      }
    });
    }




  });



</script>

@endsection
