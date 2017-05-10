@extends('layouts.master')
@section('css')  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">


@endsection
@section('page_header')
{{$salary_grade_master->salary_grade_name}}
@endsection
@section('page_description')
Set up new Salary Grade
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('salary_grade') !!}
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
          <!-- <h3 class="box-title">Salary Grade Details</h3> -->
          <button class="btn btn-xs btn-info pull-left" id="addRow">Add New Row</button>  
        </div>
        <div class="box-body"> 

          <div class="col-md-12"> 
            <div id="table-remarks" >

            </div>
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr> 
                  <th>Salary Head Name</th>
                  <th>Amount Type</th>
                  <th>Amount</th> 
                  <th>Action</th> 
                </tr>
              </thead>
              <tfoot>
                <tr> 
                  <th>Salary Head Name</th>
                  <th>Amount Type</th>
                  <th>Amount</th> 
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

<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('js/utils/utils.js')}}"></script>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });   
});//document ready



  $(document).ready(function() {
    var table = $('#example').DataTable(); 
    $.ajax("{{URL::to('/salary_grade/salary_grade_info/').'/'.$salary_grade_master->id}}", {
      data: {
        format: 'json'
      },
      error: function() { 
      },type: 'GET',
      success: function(data) { 
       $.each(data, function(i, item) { 
        renderTheTable(item);
      });
     }
   });

    var readyToPost=0; //0 for error 1 for ready 


    $('#addRow').on( 'click', function () {
      table.row.add([
        '<select  class="salary_head_id form-control table-form"></select>',
        '<select class="amount_type form-control"><option value="1">Taka</option><option value="0">% of Basic Salary</option></select>',
        '<input type="number"  class="amount form-control" placeholder="Amount">', 
        '<button class="btn btn-xs btn-danger pull-left deleteButton" >Delete Row</button>', 
        ]).draw( false );

      var salary_head_id=$('.salary_head_id');
      parameters = {
        placeholder: "Salary Head Id",
        url: '{{URL::to("/")}}/salary_head/auto/salary_head',
        selector_id:salary_head_id, 
        data:{}
      }
      init_select2_dynamic(parameters); 
    } );


    // Automatically add a first row of data
    // $('#addRow').click();

    $('body').on('click', '.deleteButton', function(e) {
      var tr=$(this).parents("tr");
      table.row(tr).remove().draw(false);  
    }); 


    $('body').on('click', '#btn_submit', function() {
      $('#example > tbody  > tr').each(function() {
        if ($(this).find(".salary_head_id").val()==null || $(this).find(".amount").val()=="") {
          $("#table-remarks").html('<h1>The form is incomplete. </h1>').css("display","block").delay(5000).fadeOut(400);
          readyToPost=0;
          return;
        }
        readyToPost=1;
      });
      if (readyToPost==1) {
        postTableData();
      }
    }); 


    function postTableData(){ 
      var jsonObj=[];
      var item;
      $('#example > tbody  > tr').each(function() {
        item={};
        item["salary_head_id"]=$(this).find(".salary_head_id").val();
        item["amount_type"]=$(this).find(".amount_type").val();
        item["amount"]=$(this).find(".amount").val();
        item["salary_grade_master_id"]={{$salary_grade_master->id}};
        jsonObj.push(item);
      });
      jsonObj=JSON.stringify(jsonObj);
      // console.log(jsonObj);
      $.ajax({
        type: "POST",
        data: {"salary_grade_master_id":{{$salary_grade_master->id}},"data":jsonObj},
        url: "{{URL::to('/salary_grade/store_grade_info')}}",
        success:function(data){ 
          window.location.reload();
        }
      });
    }
    function renderTheTable(item){ 
      table.row.add([
        '<select  class="salary_head_id form-control table-form"></select>',

        '<select class="amount_type form-control"></select>' 
        ,
        '<input type="number"  class="amount form-control" placeholder="Amount">', 
        '<button class="btn btn-xs btn-danger pull-left deleteButton" >Delete Row</button>', 
        ]).draw( false );

      // console.log(item);
      var salary_head_id=$('.salary_head_id');
      parameters = {
        placeholder: "Salary Head Id",
        url: '{{URL::to("/")}}/salary_head/auto/salary_head',
        selector_id:salary_head_id, 
        data:{}
      }
      init_select2_dynamic(parameters);

      $newOption = $("<option></option>").val(item.salary_head_id).text(item.salary_head_name)
      salary_head_id.append($newOption).trigger('change'); 

      if (item.amount_type==1) {

        $('.amount_type').append('<option value="1">Taka</option><option value="0">% of Basic Salary</option>'); 
      }else{ 
        $('.amount_type').append('<option value="0">% of Basic Salary</option><option value="1">Taka</option>'); 
      }
      $('.amount').val(item.amount); 
    }


    $('body').on('change', '.salary_head_id', function() { 
      var id=$(this).val();
      if(xyz(id)){ 
        $("this option[value='"+id+"']").remove();
      }
    }); 

    function xyz(id){
      console.log(id);
      var returnValue=false;
      $('#example > tbody  > tr').each(function(){
        if ($(this).find(".salary_head_id").val()==id) { 
          returnValue=true;
        } 
      });
      return returnValue;
    }

  });



</script>

@endsection
