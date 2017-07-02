@extends('layouts.master')
@section('css')  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
@endsection
@section('page_header')
Attendance Deduction
@endsection
@section('page_description')
Set up Attendance Dedeuction Policy
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('attendance_deduction') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!--  Permission List-->
    <div class="col-lg-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Attendance Deduction Policies List</h3>
        </div>
        <div class="box-body"> 
          <table id="all_role_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Policy Name</th> 
                <th>Late Entry Time</th>  
                <th>Early Out Time</th>   
                <th>LateMarks Count</th>   
                <th>Deduction Count</th>   
                <th>Late Mark Valid</th>   
                <th>EarlyOut Count</th>   
                <th>Deduction Count</th>   
                <th>Early Out Valid</th>   
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
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script>

  $(document).ready(function () {

   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
     "ajax": "{{URL::to('/attendance_deduction/get_all_deduction_policies')}}",
     "columns": [ 


     {"data": "deduction_policy_name"}, 
     {"data": "late_entry_time"}, 
     {"data": "early_out_time"}, 
     {
      "data": "late_entry_day_count",
      "render":function(data, type, row, meta){
       if ((data!=null) && (data!="") ) {
        return data+" days"
      }else{
        return "--";
      }
    }
  },{
    "data": "late_entry_deduction_day",
    "render":function(data, type, row, meta){
     if ((data!=null) && (data!="") ) {
      return data+" days"
    }else{
      return "--";
    }
  }
}, {
  "data": "late_entry_deduction_valid",
  "render":function(data, type, row, meta){
   if (data==1) {
    return "Yes";
  }else{
    return "No"
  }
}
},{
  "data": "early_out_day_count",
  "render":function(data, type, row, meta){
   if ((data!=null) && (data!="") ) {
    return data+" days"
  }else{
    return "--";
  }
}
},{
  "data": "early_out_deduction_day",
  "render":function(data, type, row, meta){
   if ((data!=null) && (data!="") ) {
    return data+" days"
  }else{
    return "--";
  }
}
}, {
  "data": "early_out_deduction_valid",
  "render":function(data, type, row, meta){
   if (data==1) {
    return "Yes";
  }else{
    return "No"
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
 // console.log(branch_id);

 $('#delete_role').click(function(e){
  // console.log("sa");
  event.preventDefault();
  $.ajax({
   cache: false,
   type: 'DELETE',
   url: '/attendance_deduction/' + branch_id,
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
