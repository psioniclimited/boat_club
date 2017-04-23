@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
@endsection
@section('page_header')
Work Shift
@endsection
@section('page_description')
Set up Work Shift
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('work_shift') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-6"> 
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">WorkShift Create</h3>
                </div>
                <!-- {!! Form::open(array('route'=>'work_shift.store','id'=>'add_work_shift_form','class' => 'form-horizontal')) !!} -->
                {!! Form::open(array('route' => array('work_shift.update', $work_shift->id), 'id' => 'add_work_shift_form', 'method'=>'PUT')) !!}                    
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('shift_name')) has-error @endif">
                            <label for="name" class="control-label">Work Shift Name*</label> 
                            <input type="text" class="form-control" id="shift_name" name="shift_name" placeholder="Enter name" value="{{old('shift_name')}}"> 
                            @if ($errors->has('shift_name')) <p class="help-block">{{ $errors->first('shift_name') }}</p> @endif                             
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group @if ($errors->has('start_from')) has-error @endif">
                              <label>Starting Time*</label>
                              <div class="input-group"> 
                                <input type="text" class="form-control pull-right" id="start_from" name="start_from" placeholder="Select Start Time" value="{{old('start_from')}}" readonly="">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div><!-- /.input group -->
                            @if ($errors->has('start_from')) <p class="help-block">{{ $errors->first('start_from') }}</p> @endif                                                  
                        </div><!-- /.form group -->
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group @if ($errors->has('end_to')) has-error @endif">
                          <label>Finish Time*</label>
                          <div class="input-group"> 
                          <input type="text" class="form-control pull-right" id="end_to" name="end_to" placeholder="Select Finish Time" value="{{old('end_to')}}" readonly="">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div><!-- /.input group -->
                        @if ($errors->has('end_to')) <p class="help-block">{{ $errors->first('end_to') }}</p> @endif                      
                    </div><!-- /.form group -->
                </div>
            </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer"> 
            <button type="submit" class="btn btn-primary pull-left">Submit</button>
        </div> <!-- /.box-footer -->
        {!! Form::close() !!}
    </div><!-- /.box -->
</div><!-- /col-md-6 -->







<!--  Permission List-->
<div class="col-lg-6">
  <div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Work Shift List</h3>
    </div>
    <div class="box-body"> 
        <table id="all_role_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Name</th> 
                <th>Startin Time</th> 
                <th>Finish Time</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody> 
    </table>
</div>
</div>
</div><!--col-lg-6-->
</div>  <!--row-->
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
<script src="{{asset('bower_components/AdminLTE')}}/plugins/timepicker/bootstrap-timepicker.js"></script>

<!-- 
 <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
-->
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
    $('#add_work_shift_form').validate({
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
            shift_name: {required: true, minlength: 4},
            start_from: {required: true},
            end_to: {required: true}
        },
        messages: {
            shift_name: {required: "Please give name"},
            start_from: {required: "Please Select Start Time"},
            end_to: {required: "Please Select End Time"}
        }
    });




//initialize timepicker on start_from 
$('#start_from').timepicker({  
   showInputs: false
});

//initialize timepicker on end_to
$('#end_to').timepicker({ 
   showInputs: false
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
       "ajax": "{{URL::to('/work_shift/get_all_work_shifts')}}",
       "columns": [ 
       {"data": "shift_name"}, 
       {"data": "start_from"}, 
       {"data": "end_to"}, 
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
     url: '/work_shift/' + branch_id,
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
