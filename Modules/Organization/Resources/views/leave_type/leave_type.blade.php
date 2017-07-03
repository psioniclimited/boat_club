@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">

@endsection
@section('page_header')
Leave Type
@endsection
@section('page_description')
Set up your Leave Types
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('leave_type') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Leave Type Create</h3>
                </div> 
                {!! Form::open(array('route'=>'leave_type.store','id'=>'add_leave_type','class' => 'form-horizontal')) !!}
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('leave_type_name')) has-error @endif">
                            <label for="name" class="control-label">Name*</label> 
                            <input type="text" class="form-control" id="leave_type_name" name="leave_type_name" placeholder="Enter name" value="{{old('leave_type_name')}}"> 
                            @if ($errors->has('leave_type_name')) <p class="help-block">{{ $errors->first('leave_type_name') }}</p> @endif                             
                        </div> 
                    </div>


                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('payment_type')) has-error @endif">
                            <label for="name" class="control-label">Payment Type</label> 
                            <div class="checkbox">
                                <label><input type="checkbox" class="minimal" name="payment_type" id="payment_type" value="1">With Pay</label>
                            </div>
                            @if ($errors->has('payment_type')) <p class="help-block">{{ $errors->first('payment_type') }}</p> @endif                             
                        </div>
                    </div> 


                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('carry_forward')) has-error @endif">
                          <label for="name" class="control-label">Carry Forward</label> 
                          <div class="checkbox">
                            <label><input type="checkbox" class="minimal" name="carry_forward" id="carry_forward" value="1">Merge Unused Leave with next year</label>
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
    <!--  Permission List-->
    <div class="col-lg-7">
      <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Leave Type List</h3>
        </div>
        <div class="box-body"> 
            <table id="all_role_table" class="table table-bordered table-hover">
                <thead>
                  <tr> 
                    <th>Name</th>
                    <th>Carry Forward</th> 
                    <th>With Pay</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody> 
        </table>
    </div>
</div>
</div>
</div>    
</section>
<!-- /.content -->


<!-- Delete Customer Modal -->
<div class="modal fade" id="confirm_delete" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Remove Parmanently</h4>
   </div>
   <div class="modal-body">
       <p>Are you sure about this ?</p>
   </div>
   <div class="modal-footer">
       <button type="button" class="btn btn-danger" id="delete_role">Delete</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
</div>
<!-- /. Modal content ends here -->
</div>
</div>
<!--  Delete Customer Modal ends here -->
@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
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
    $('#add_leave_type').validate({
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
            leave_type_name: {required: true}, 
        },
        messages: {
            leave_type_name: {required: "Please give name"}
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


    //Datatable Generation
    var table = $('#all_role_table').DataTable({
       "paging": true,
       "lengthChange": true,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "processing": true,
       "serverSide": true,
       "ajax": "{{URL::to('/leave_type/get_all_leave_types')}}",
       "columns": [ 
       {"data": "leave_type_name"},
       {
        "data": "carry_forward",
        "render":function(data, type, row, meta){
            if(data==1){
                return "yes";
            }else{
                return "No";
            }
        }

    },     {
        "data": "payment_type",
        "render":function(data, type, row, meta){
            if(data==1){
                return "Yes";
            }else{
                return "No";
            }
        }

    },
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    "order": [[0, 'asc']]
});  






// Delete Permission
$('#confirm_delete').on('show.bs.modal', function(e) {
 var $modal = $(this),
 branch_id = e.relatedTarget.id;

 $('#delete_role').click(function(e){
   event.preventDefault();
   $.ajax({
     cache: false,
     type: 'DELETE',
     url: '/branch/' + branch_id,
     data: branch_id,
     success: function(data){
       table.ajax.reload(null, false);
       $('#confirm_delete').modal('toggle');
   }
});
});
});



});//document ready



</script>

@endsection
