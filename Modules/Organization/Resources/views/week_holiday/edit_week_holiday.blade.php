@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/all.css">

@endsection
@section('page_header')
Weekly Holiday
@endsection
@section('page_description')
Set up Weekly Holiday
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('week_holiday') !!}
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
          <h3 class="box-title">Weekly Holiday Edit</h3>
        </div> 

        {!! Form::open(array('route' => array('week_holiday.update', $week_holiday_master->id), 'id' => 'add_week_holiday_form', 'method'=>'PUT')) !!} 

        <div class="box-body">
          <div class="col-md-12"> 

            <div class="form-group @if ($errors->has('week_holiday_master_name')) has-error @endif">
              <label for="name" class="control-label">Week Holiday Name*</label> 
              <input type="text" class="form-control" id="week_holiday_master_name" name="week_holiday_master_name" placeholder="Enter name" value="{{$week_holiday_master->week_holiday_master_name}}" > 
              @if ($errors->has('week_holiday_master_name')) <p class="help-block">{{ $errors->first('week_holiday_master_name') }}</p> @endif                             
            </div>

            <div class="form-group ">
              <label for="name" class="control-label">Select Days*</label> 

              @foreach($day_names as $day)
              <div class="checkbox">
                <label>
                   <input type="checkbox" class="minimal" name="checked_days[]" id="checked_days[]" value="{{$day->id}}"

                  @if(!empty($week_holiday_master->week_holiday))       
                  @foreach($week_holiday_master->week_holiday as $selected_day)
                  @if($selected_day->day_name_id==$day->id) 
                   checked
                  @endif 
                  @endforeach
                  @endif
 
                   >{{$day->dayname}}

                </label>
              </div>
              @endforeach                          
            </div>


          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer"> 
          <button type="submit" id="btn-submit" class="btn btn-primary pull-left">Submit</button>
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
                <th>Days</th>  
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
<script src="{{asset('bower_components/AdminLTE')}}/plugins/iCheck/icheck.min.js"></script>

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

    $('#add_week_holiday_form').validate({
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
        week_holiday_master_name: {required: true, minlength: 4}, 
      },
      messages: {
        week_holiday_master_name: {required: "Please give name"}
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
     "ajax": "{{URL::to('/week_holiday/get_all_week_holidays')}}",
     "columns": [ 
     {"data": "week_holiday_master_name"}, 
     {data: 'days', name: 'days'},
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
     url: '/week_holiday/' + branch_id,
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
