@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">  

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<style>
  .col-md-6{
    padding-right: 20px !important;
  }
</style>
@endsection
@section('page_header')
Loan Application
@endsection
@section('page_description')
Create Loan Application
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('loan_application') !!}
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
        <h3 class="box-title">Loan Application Create</h3>
      </div> 

      {!! Form::open(array('route' => array('loan_application.update', $loan_application->id), 'id' => 'add_loan_application', 'method'=>'PUT')) !!}     

      <div class="box-body">

       <div class="col-md-6">  
        <div class="form-group @if ($errors->has('loan_status_id')) has-error @endif">
          <label for="name" class="control-label">Status*</label>
          <select class="form-control" id="loan_status_id" name="loan_status_id"> 

            @if($loan_application->loan_status->change_type==0)
            <option value="{{$loan_application->loan_status->id}}">{{$loan_application->loan_status->loan_status_name}}</option>
            @else 

            @foreach($loan_status as $row)
            @if($row->change_type==1)
            @if($row->id==$loan_application->loan_status_id)
            <option value="{{$row->id}}" selected="">{{$row->loan_status_name}}</option>
            @else
            <option value="{{$row->id}}">{{$row->loan_status_name}}</option>
            @endif 
            @endif 
            @endforeach
            P 
            @endif    
          </select>
          @if ($errors->has('loan_status_id')) <p class="help-block">{{ $errors->first('loan_status_id') }}</p> @endif                             
        </div>  
      </div><!-- /.col-md-6 -->


      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('loan_type_id')) has-error @endif">
          <label for="name" class="control-label">Loan Type*</label>
          <select class="form-control" id="loan_type_id" name="loan_type_id" > 
          </select>   
          @if ($errors->has('loan_type_id')) <p class="help-block">{{ $errors->first('loan_type_id') }}</p> @endif                             
        </div>  
      </div><!-- /.col-md-6 -->

      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('annual_interest_rate')) has-error @endif">
          <label for="name" class="control-label">Interest Rate(%) Per Year*</label>
          <input type="text" class="form-control" id="annual_interest_rate"  name="annual_interest_rate"  readonly="" value="{{$loan_application->annual_interest_rate}}"> 
          @if ($errors->has('annual_interest_rate')) <p class="help-block">{{ $errors->first('annual_interest_rate') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->

      <div class="col-md-12"></div>

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
          <input type="text" class="form-control" id="employee_fullname" readonly="" value="{{$loan_application->employees_master->employee_fullname}}"> 
          @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->
      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
          <label for="name" class="control-label">Employee Contact*</label>
          <input type="text" class="form-control" id="contact_number" readonly="" value="{{$loan_application->employees_master->contact_number}}"> 
          @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->




      <div class="col-md-12"> 
        <div class="form-group @if ($errors->has('reason')) has-error @endif">
          <label for="name" class="control-label">Reason</label> 
          <div class="box-body pad"> 
            <textarea name="reason" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$loan_application->reason}}</textarea>
          </div>
          @if ($errors->has('reason')) <p class="help-block">{{ $errors->first('reason') }}</p> @endif                             
        </div>
      </div> 


      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('loan_amount')) has-error @endif">
          <label for="name" class="control-label">Loan Amount*</label>
          <input type="number" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" min="0" value="{{$loan_application->loan_amount}}"> 
          @if ($errors->has('loan_amount')) <p class="help-block">{{ $errors->first('loan_amount') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->


      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('monthly_repayment_amount')) has-error @endif">
          <label for="name" class="control-label">Monthly Repayment Amount*</label>
          <input type="number" class="form-control" id="monthly_repayment_amount" name="monthly_repayment_amount" placeholder="Installment Size" min="0" value="{{$loan_application->monthly_repayment_amount}}"> 
          @if ($errors->has('monthly_repayment_amount')) <p class="help-block">{{ $errors->first('monthly_repayment_amount') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->



      <div class="col-md-6">  
        <div class="form-group @if ($errors->has('required_by_date')) has-error @endif">
          <label for="name" class="control-label">Required By Date*</label>
          <input type="text" class="form-control" id="required_by_date" name="required_by_date" placeholder="Required before" value="{{$loan_application->required_by_date}}"> 
          @if ($errors->has('required_by_date')) <p class="help-block">{{ $errors->first('required_by_date') }}</p> @endif                             
        </div>   
      </div><!-- /.col-md-6 -->




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
    })   

    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'left'  // display the tips to the right of the element
      });

    // initialize validate plugin on the form
    $('#add_loan_application').validate({
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
        loan_status_id: {required: true}, 
        loan_type_id: {required: true}, 
        employees_master_id: {required: true}, 
        required_by_date: {required: true}, 
        monthly_repayment_amount: {required: true}, 
        annual_interest_rate: {required: true}, 
        loan_amount: {required: true}, 
        
      },
      messages: {
        loan_status_id: {required: "Please select  a Status"},
        loan_type_id: {required: "Please Select a Loan Type"},
        employees_master_id: {required: "Please Select an Employee"},
        required_by_date: {required: "Please Select a date"},
        monthly_repayment_amount: {required: "Please give installment size"},
        annual_interest_rate: {required: "Please give interest rate"},
        loan_amount: {required: "Please give amount of loan"},
      }
    });


    var employees_master_id=$('#employees_master_id'); 
    var loan_type_id=$('#loan_type_id'); 

    
    
    $.get( "{{URL::to('/loan_application/auto/get_employees')}}", { loan_application_id: {{$loan_application->id}} } ,function( data ) {
      init_select2_with_default_value({
        default_value: data,
        placeholder: "Employee",
        url: '{{URL::to("/")}}/employee/auto/get_employees',
        selector_id:$('#employees_master_id'),
        data:{}
      });
    });



    $.get( "{{URL::to('/loan_application/auto/get_loan_types')}}", { loan_application_id: {{$loan_application->id}} } ,function( data ) {
      init_select2_with_default_value({
        default_value: data,
        placeholder: "Leave Type",
        url: '{{URL::to("/")}}/loan_type/auto/get_loan_types',
        selector_id:$('#loan_type_id'),
        data:{}
      });
    });



    $('#required_by_date').datepicker();
    

    employees_master_id.on("select2:select",function (e) { 
      $('#employee_fullname').val(employees_master_id.select2('data')[0]['employee_fullname']);    
      $('#contact_number').val(employees_master_id.select2('data')[0]['contact_number']);   
    });

    employees_master_id.on("select2:unselect", function(evt) {
     $('#employee_fullname').val("");    
     $('#contact_number').val("");
   });


    loan_type_id.on("select2:select",function (e) { 
      $('#annual_interest_rate').val(loan_type_id.select2('data')[0]['annual_interest_rate']);   
    });

    loan_type_id.on("select2:unselect", function(evt) {
     $('#annual_interest_rate').val("");     
   });

});//document ready



</script>

@endsection
