@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">

@endsection
@section('page_header')
Loan Type
@endsection
@section('page_description')
Set up your Loan Types
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('loan_type') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row"> 
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Loan Type Create</h3>
      </div>  


      {!! Form::open(array('route' => array('loan_type.update', $loan_type->id), 'id' => 'add_loan_type', 'method'=>'PUT')) !!} 



      {!! Form::hidden('id', $loan_type->id) !!}


      <div class="box-body">


        <div class="col-md-12"> 
          <div class="form-group @if ($errors->has('loan_type_name')) has-error @endif">
            <label for="name" class="control-label">Name*</label> 
            <input type="text" class="form-control" id="loan_type_name" name="loan_type_name" placeholder="Enter name" value="{{$loan_type->loan_type_name}}"> 
            @if ($errors->has('loan_type_name')) <p class="help-block">{{ $errors->first('loan_type_name') }}</p> @endif                             
          </div> 
        </div>



        <div class="col-md-12"> 
          <div class="form-group @if ($errors->has('description')) has-error @endif">
            <label for="name" class="control-label">Description</label> 
            <div class="box-body pad"> 
              <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >{{$loan_type->description}}</textarea>
            </div> 
            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif                             
          </div>
        </div> 



        <div class="col-md-12"> 
          <div class="form-group @if ($errors->has('annual_interest_rate')) has-error @endif">
            <label for="name" class="control-label">Rate of Interest (%) Yearly</label> 
            <input type="number" class="form-control" id="annual_interest_rate" name="annual_interest_rate" placeholder="Enter Amount" value="{{$loan_type->annual_interest_rate}}" min="0"> 
            @if ($errors->has('annual_interest_rate')) <p class="help-block">{{ $errors->first('annual_interest_rate') }}</p> @endif                             
          </div>
        </div> 


        <div class="col-md-12"> 
        <div class="form-group @if ($errors->has('active')) has-error @endif">
            <label for="name" class="control-label">Status</label> 
            <div class="checkbox">
            @if($loan_type->active==0)
              <label><input type="checkbox" class="minimal" name="active" id="active" value="0" checked="">Disable</label>
            @else 
              <label><input type="checkbox" class="minimal" name="active" id="active" value="0">Disable</label>
            @endif
            </div>
            @if ($errors->has('carry_forward')) <p class="help-block">{{ $errors->first('carry_forward') }}</p> @endif                             
          </div>
        </div>        

        <!-- /.col -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer"> 
        <button type="submit" class="btn btn-primary pull-left">Submit</button>
      </div>
      <!-- /.box-footer -->
      {!! Form::close() !!}
      <!-- /.form ends here -->
    </div>
    <!-- /.box -->


  </div>    
</section>
<!-- /.content -->



@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script> 
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
    $('#add_loan_type').validate({
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
        loan_type_name: {required: true}, 
        annual_interest_rate: {required: true}, 
      },
      messages: {
        loan_type_name: {required: "Please give name"},
        annual_interest_rate: {required: "Please give Interest Rate"}
      }
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





});//document ready



</script>

@endsection
