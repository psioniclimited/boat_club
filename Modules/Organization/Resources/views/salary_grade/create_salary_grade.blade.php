@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
@endsection
@section('page_header')
Salary Grade
@endsection
@section('page_description')
Create New Salary Grade
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
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Post Office Create</h3>
        </div>
        {!! Form::open(array('route'=>'salary_grade.store','id'=>'add_salary_grade_form','class' => 'form-horizontal')) !!}
        <div class="box-body">
          <div class="col-md-12"> 
            <div class="form-group @if ($errors->has('salary_grade_name')) has-error @endif">
              <label for="name" class="control-label">Salary Grade Name*</label> 
              <input type="text" class="form-control" id="salary_grade_name" name="salary_grade_name" placeholder="Enter name" value="{{old('salary_grade_name')}}"> 
              @if ($errors->has('salary_grade_name')) <p class="help-block">{{ $errors->first('salary_grade_name') }}</p> @endif                             
            </div>
            <div class="form-group @if ($errors->has('basic_salary')) has-error @endif">
              <label for="name" class="control-label">Basic Salary*</label> 
              <input type="text" class="form-control" id="basic_salary" name="basic_salary" placeholder="Enter Basic Salary" value="{{old('basic_salary')}}"> 
              @if ($errors->has('basic_salary')) <p class="help-block">{{ $errors->first('basic_salary') }}</p> @endif                             
            </div>                           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer"> 
          <button type="submit" name="submit"  class="btn btn-primary pull-left" value="submit">Submit</button> 
          <!-- <button style="margin-left: 10px" type="submit" value="submit_and_edit" name="submit_and_edit"  class="btn btn-info pull-left">Submit & Edit</button> -->
        </div>
        <!-- /.box-footer -->
        {!! Form::close() !!}
        <!-- /.form ends here -->
      </div>
      <!-- /.box -->
    </div>
  </div>    
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

    // initialize validate plugin on the form
    $('#add_salary_grade_form').validate({
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
        salary_grade_name: {required: true, minlength: 4},
        basic_salary: {required: true}
      },
      messages: {
        salary_grade_name: {required: "Please give name"},
        basic_salary: {required: "Please give a Basic Salary"}, 
      }
    });
});//document ready



</script>

@endsection
