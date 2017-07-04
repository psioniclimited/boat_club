@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">  

@endsection

@section('page_header')
Leave Package Setup
@endsection
@section('page_description')
Create New Leave Package
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('leave_package') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12"> 

      <form action="" name="add_leave_package_form" id="add_leave_package_form" method="post">

        <div class="box box-info">


          <div class="box-header with-border">
            <h3 class="box-title">Leave Package Create</h3>
          </div>

          <div class="box-body">

            <div class="col-md-12"> 
              <div class="form-group @if ($errors->has('leave_package_name')) has-error @endif">
                <label for="name" class="control-label">Package Name*</label> 
                <input type="text" class="form-control" id="leave_package_name" name="leave_package_name" placeholder="Enter Name" value="{{old('leave_package_name')}}" > 
                @if ($errors->has('leave_package_name')) <p class="help-block">{{ $errors->first('leave_package_name') }}</p> @endif                             
              </div>
            </div> 

          </form>


          <div class="col-md-12">
            <table id="leave_package_details_table" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
              <thead>
                <tr> 
                  <th>Leave Type</th>
                  <th>Number Of Days</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($leave_types as $row)
                <tr>
                  <td><input type="text" class="form-control" readonly="" value="{{$row->leave_type_name}}">  <input type="hidden" class="leave_type_id" value="{{$row->id}}"></td>
                  <td><input type="number" class="number_of_days form-control" min="0" step="1" value="0"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
        </div> <!-- /.box-body --> 

        <div class="box-footer"> 
          <button  id="btn-submit" class="btn btn-primary pull-left">Submit</button>
        </div>
        <!-- /.box-footer -->
      </div><!-- /.box -->

    </div><!-- /col-md-12 -->
    



  </div>  <!--row-->
</section>
<!-- /.content -->



@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>   

<script>

  $(document).ready(function () {
    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#add_leave_package_form').validate({
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
        leave_package_name: {required: true}
      },
      messages: {
        leave_package_name: {required: "Please give name"}
      }
    });


    $('#btn-submit').on('click',function(e){
      if(!$('#add_leave_package_form').valid()){ 
        return;
      }   
      // alert("asjd");
      e.preventDefault()
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
      
      $.ajax({
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,  
        dataType: "JSON",  
        url: "{{URL::to('/leave_package')}}", 
        success:function(data){    

          if(data.error!=undefined){ 
            $("#table-remarks .alert_message").html(data.error);  
            $("#table-remarks").css("display","block").delay(10000).fadeOut(400);
          }else{ 
           // window.location.replace(data.redirect); 
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


    function generateJsonObjectWithForm(table_name){
      var formData = new FormData($("#add_leave_package_form")[0]); 
      formData.append('leave_package_details',generateJsonStringFromTables());

      return formData;
    }


function generateJsonStringFromTables(){

      var jsonObj=[];
      var item; 

      $('#leave_package_details_table > tbody  > tr').each(function() {
          item={}; 
          
          item["leave_type_id"]=$(this).find(".leave_type_id").val(); 

          if ($(this).find(".number_of_days").val()==null) {
             item["number_of_days"]=0; 
          }else{
             item["number_of_days"]=$(this).find(".number_of_days").val();  
          } 
          
          jsonObj.push(item);
      }); 

      jsonObj=JSON.stringify(jsonObj);
      return jsonObj;
}


});//document ready



</script>


@endsection
