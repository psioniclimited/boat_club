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
Loan
@endsection
@section('page_description')
List of Loan Applications
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('loan_approval') !!}
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

      {!! Form::open(array('route' => array('loan_approval.update', $loan_application->id), 'id' => 'add_loan_application', 'method'=>'PUT')) !!}     

      <div class="box-body">

       <div class="col-md-6">  
        <div class="form-group @if ($errors->has('loan_status_id')) has-error @endif">
          <label for="name" class="control-label">Status*</label>
          <select class="form-control" id="loan_status_id" name="loan_status_id"> 


            @foreach($loan_status as $row)
            @if($row->change_type==0)
            @if($row->id==$loan_application->loan_status_id)
            <option value="{{$row->id}}" selected="">{{$row->loan_status_name}}</option>
            @else
            <option value="{{$row->id}}">{{$row->loan_status_name}}</option>
            @endif 
            @endif 
            @endforeach  
          </select>
          @if ($errors->has('loan_status_id')) <p class="help-block">{{ $errors->first('loan_status_id') }}</p> @endif                             
        </div>  
      </div> 

      <div class="col-md-6">   
        <div class="form-group >
          <label for="name" class="control-label">Loan Type*</label>
          <input type="text" class="form-control"  readonly="" value="{{$loan_application->loan_type->loan_type_name}}">   
        </div>
      </div><!-- /.col-md-6 -->

      <div class="col-md-6">  
        <div class="form-group>
          <label for="name" class="control-label">Interest Rate(%) Per Year*</label>
          <input type="text" class="form-control" readonly="" value="{{$loan_application->annual_interest_rate}}">  
        </div>   
      </div><!-- /.col-md-6 -->

      <div class="col-md-12"></div>

      <div class="col-md-6">  
        <div class="form-group">
          <label for="name" class="control-label">Employee*</label>
          <input type="text" class="form-control"  readonly="" value="{{$loan_application->employees_master->employee_code}}">                              
        </div>   
      </div><!-- /.col-md-6 -->


      <div class="col-md-6">  
        <div class="form-group">
          <label for="name" class="control-label">Employee Name*</label>
          <input type="text" class="form-control"  readonly="" value="{{$loan_application->employees_master->employee_fullname}}">   
        </div>   
      </div><!-- /.col-md-6 -->
      <div class="col-md-6">  
        <div class="form-group">
          <label for="name" class="control-label">Employee Contact*</label>
          <input type="text" class="form-control"  readonly="" value="{{$loan_application->employees_master->contact_number}}">                      
        </div>   
      </div><!-- /.col-md-6 -->




      <div class="col-md-12"> 
        <div class="form-group">
          <label for="name" class="control-label">Reason</label> 
          <div class="box-body pad"> 
            <textarea  readonly="" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$loan_application->reason}}</textarea>
          </div>                            
        </div>
      </div> 


      <div class="col-md-6">  
        <div class="form-group">
          <label for="name" class="control-label">Loan Amount*</label>
          <input type="number" class="form-control" readonly="" placeholder="Loan Amount" min="0" value="{{$loan_application->loan_amount}}">  
        </div>   
      </div><!-- /.col-md-6 -->


      <div class="col-md-6">  
        <div class="form-group">
          <label for="name" class="control-label">Monthly Repayment Amount*</label>
          <input type="number" class="form-control" readonly="" placeholder="Installment Size" min="0" value="{{$loan_application->monthly_repayment_amount}}">                       
        </div>   
      </div><!-- /.col-md-6 -->



      <div class="col-md-6">  
        <div class="form-group ">
          <label for="name" class="control-label">Required By Date*</label>
          <input type="text" class="form-control" readonly="" placeholder="Required before" value="{{$loan_application->required_by_date}}">                           
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
       
        
      },
      messages: {
        loan_status_id: {required: "Please select  a Status"},
 
      }
    });


});//document ready



</script>

@endsection
