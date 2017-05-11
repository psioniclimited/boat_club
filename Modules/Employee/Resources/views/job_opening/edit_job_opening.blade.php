@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"> 
@endsection
@section('page_header')
Job Opening
@endsection
@section('page_description')
Set up Job Opening
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('job_opening') !!}
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

        {!! Form::open(array('route' => array('job_opening.update', $job_opening->id), 'id' => 'add_job_opening_form', 'method'=>'PUT')) !!}    
        <div class="box-body">
          <div class="col-md-12"> 

            <div class="form-group @if ($errors->has('job_title')) has-error @endif">
              <label for="name" class="control-label">Job Title*</label> 
              <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Job Title" value="{{$job_opening->job_title}}" > 
              @if ($errors->has('job_title')) <p class="help-block">{{ $errors->first('job_title') }}</p> @endif                             
            </div>

            <div class="form-group @if ($errors->has('job_opening_status')) has-error @endif">
              <label for="name" class="control-label">Job Status*</label> 
              <select name="job_opening_status" id="job_opening_status" class="form-control">
                @if($job_opening->job_opening_status==1)
                <option value="1">Open</option>
                <option value="0">Closed</option>
                @else
                <option value="0">Closed</option>
                <option value="1">Open</option>
                @endif  
              </select>
              @if ($errors->has('job_opening_status')) <p class="help-block">{{ $errors->first('job_opening_status') }}</p> @endif                             
            </div>
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Description</h3>
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
              <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$job_opening->description}}</textarea> 
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
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    <script>

      $(document).ready(function () {
        $(".textarea").wysihtml5();


    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#add_job_opening_form').validate({
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
        job_title: {required: true, minlength: 4}
      },
      messages: {
        job_title: {required: "Please give Title"}, 
      }
    });

    $('#holiday_date').datepicker();
});//document ready



</script>

@endsection
