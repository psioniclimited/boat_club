@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> 

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<style>
  .col-md-6{
    padding-right: 40px;
  }
</style>
@endsection
@section('page_header')
Offer Letter
@endsection
@section('page_description')
Create Offer Letter
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('offer_letter') !!}
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
          <h3 class="box-title">Create Offer Letter</h3>
        </div> 

        {!! Form::open(array('route' => array('offer_letter.update', $offer_letter->id), 'id' => 'add_offer_letter_form', 'method'=>'PUT')) !!}  
        <div class="box-body">

          <div class="col-md-6"> 
            <div class="form-group @if ($errors->has('job_applicant_id')) has-error @endif">
              <label for="name" class="control-label">Job Applicant*</label>
              <select class="form-control" id="job_applicant_id" name="job_applicant_id" > 
              </select>                 
              @if ($errors->has('job_applicant_id')) <p class="help-block">{{ $errors->first('job_applicant_id') }}</p> @endif                             
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
            <div class="form-group @if ($errors->has('offer_date')) has-error @endif">
              <label for="name" class="control-label">Offer Date*</label>
              <input type="text" class="form-control" id="offer_date" name="offer_date" placeholder="Select Issue Date" value="{{$offer_letter->offer_date}}" data-date-format='yyyy-mm-dd'>                 
              @if ($errors->has('offer_date')) <p class="help-block">{{ $errors->first('offer_date') }}</p> @endif                             
            </div> 
          </div><!-- /.col-md-6 -->

          <div class="col-md-6"> 
            <div class="form-group @if ($errors->has('status')) has-error @endif">
              <label for="name" class="control-label">Status*</label>
              <select name="status" id="status" class="form-control">
               <option value="2" @if($offer_letter->status==2) selected @endif>On Hold</option>
               <option value="1" @if($offer_letter->status==1) selected @endif>Accepted</option>
               <option value="0" @if($offer_letter->status==0) selected @endif>Rejected</option>
             </select>
             @if ($errors->has('status')) <p class="help-block">{{ $errors->first('status') }}</p> @endif                             
           </div> 
         </div><!-- /.col-md-6 -->


       </div> <!-- /.box-body --> 

       <div class="box">
        <div class="box-header">
          <h3 class="box-title">Terms And Conditions</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad"> 
              <textarea name="terms_and_conditions" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$offer_letter->terms_and_conditions}}</textarea> 
            </div>
          </div>  

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

  <script src="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->
  <script src="{{asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js')}}"></script>

  <script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>        
  <script src="{{asset('js/utils/utils.js')}}"></script>
  <script>

    $(document).ready(function () {
      $(".textarea").wysihtml5();


    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#add_offer_letter_form').validate({
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
        job_applicant_id: {required: true},
        department_branch_id: {required: true},
        department_id: {required: true},
        designation_id: {required: true},
        offer_date: {required: true},
        status: {required: true},
      },
      messages: {
       job_applicant_id: {required: "Select an Applicant"},
       department_branch_id: {required: "Select a Branch"},
       department_id: {required: "Select a Department"},
       designation_id: {required: "Select a Designation"},
       offer_date: {required: "Select a Date"},
       status: {required: "Select Status"}, 
     }
   });

    $('#holiday_date').datepicker();






    var job_applicant_id=$('#job_applicant_id'); 
// initialize select2 for post Office
$.get( "{{URL::to('/offer_letter/auto/get_job_applicant')}}", { offer_letter_id: {{$offer_letter->id}} } ,function( data ) { 
  init_select2_with_default_value({
    default_value: data,
    placeholder: "Job Applicant",
    url: '{{URL::to("/")}}/job_applicant/auto',
    selector_id:job_applicant_id, 
    data:{}
  });
});


var department_branch_id=$('#department_branch_id'); 
// initialize select2 for post Office
$.get( "{{URL::to('/offer_letter/auto/get_department_branch')}}", { offer_letter_id: {{$offer_letter->id}} } ,function( data ) { 
  init_select2_with_default_value({
    default_value: data,
    placeholder: "Job Branch",
    url: '{{URL::to("/")}}/branch/auto/get_branchs',
    selector_id:department_branch_id, 
    data:{}
  });
});

var department_id=$('#department_id'); 
// initialize select2 for post Office
$.get( "{{URL::to('/offer_letter/auto/get_department')}}", { offer_letter_id: {{$offer_letter->id}} } ,function( data ) { 
  init_select2_with_default_value_with_one_parameter({
    default_value: data,
    placeholder: "Job Department",
    url: '{{URL::to("/")}}/branch/auto/get_departments',
    value_id:$('#department_branch_id'),
    selector_id:department_id, 
    data:{}
  });
});




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
// initialize select2 for post Office
$.get( "{{URL::to('/offer_letter/auto/get_designation')}}", { offer_letter_id: {{$offer_letter->id}} } ,function( data ) { 
  init_select2_with_default_value({
    default_value: data,
    placeholder: "Job Designation",
    url: '{{URL::to("/")}}/designation/auto/get_designations',
    selector_id:designation_id, 
    data:{}
  });
});
$('#offer_date').datepicker();
});//document ready



</script>

@endsection
