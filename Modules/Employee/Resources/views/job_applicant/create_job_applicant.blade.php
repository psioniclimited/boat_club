@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> 
<style>
  .col-md-6{
    padding-right: 40px;
  }
</style>

@endsection
@section('page_header')
Job Applicant
@endsection
@section('page_description')
Create New Job Applicant
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('job_applicant') !!}
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
          <h3 class="box-title">Create Job Opening</h3>
        </div>

        {!! Form::open(array('route'=>'job_applicant.store','id'=>'add_job_applicant_form','files' => true,'class' => 'form-horizontal')) !!}
        <div class="box-body">

          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('applicant_name')) has-error @endif">
              <label for="name" class="control-label">Applicant Name*</label> 
              <input type="text" class="form-control" id="applicant_name" name="applicant_name" placeholder="Enter Applicant Name" value="{{old('applicant_name')}}" > 
              @if ($errors->has('applicant_name')) <p class="help-block">{{ $errors->first('applicant_name') }}</p> @endif                             
            </div>
            <div class="form-group @if ($errors->has('applicant_email')) has-error @endif">
              <label for="name" class="control-label">Email Address</label> 
              <input type="text" class="form-control" id="applicant_email" name="applicant_email" placeholder="Enter Email Address" value="{{old('applicant_email')}}" > 
              @if ($errors->has('applicant_email')) <p class="help-block">{{ $errors->first('applicant_email') }}</p> @endif                             
            </div>
            <div class="form-group @if ($errors->has('applicant_contact')) has-error @endif">
              <label for="name" class="control-label">Contact No*</label> 
              <input type="text" class="form-control" id="applicant_contact" name="applicant_contact" placeholder="Enter Contact Number" value="{{old('applicant_contact')}}" > 
              @if ($errors->has('applicant_contact')) <p class="help-block">{{ $errors->first('applicant_contact') }}</p> @endif                             
            </div>
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('job_openings_id')) has-error @endif">
              <label for="name" class="control-label">Job Opening*</label> 
              <select name="job_openings_id" id="job_openings_id" class="form-control"> 
              </select>
              @if ($errors->has('job_openings_id')) <p class="help-block">{{ $errors->first('job_openings_id') }}</p> @endif                             
            </div>
            <div class="form-group @if ($errors->has('job_applicant_status_id')) has-error @endif">
              <label for="name" class="control-label">Job Applicant Status*</label> 
              <select name="job_applicant_status_id" id="job_applicant_status_id" class="form-control"> 
                @foreach($job_applicant_status as $status)
                <option value="{{$status->id}}">{{$status->status}}</option>
                @endforeach
              </select>
              @if ($errors->has('job_applicant_status_id')) <p class="help-block">{{ $errors->first('job_applicant_status_id') }}</p> @endif                             
            </div>
          </div><!-- /.col-md-6 -->


        </div> <!-- /.box-body --> 

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Cover Letter</h3>
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
                <textarea name="cover_letter" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div> 
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Resume</h3>
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
                    <input type="file" name="resume">
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
        <script src="{{asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js')}}"></script>

        <script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>        
        <script src="{{asset('js/utils/utils.js')}}"></script>


        <!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->

        <script>

          $(document).ready(function () {
            $(".textarea").wysihtml5();


    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'left'  // display the tips to the right of the element
      });

    $('#add_job_applicant_form').validate({
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
        applicant_name :{required: true, minlength: 4},
        applicant_contact : {required: true},
        job_openings_id :{required: true},
      },
      messages: {
        job_title: {required: "Please give Title"}, 
        applicant_contact: {required: "Give contact information"},
        job_openings_id :{required: "Select Job Opening"},
      }
    });


    var job_openings=$('#job_openings_id');
    console.log(job_openings);
    parameters = { 
      placeholder: "Job Opening",
      url: '{{URL::to("/")}}/job_opening/auto',
      selector_id:job_openings, 
      data:{}
    }

    init_select2(parameters);


});//document ready



</script>

@endsection
