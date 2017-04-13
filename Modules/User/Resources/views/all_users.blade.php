@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css"> 
@endsection
@section('page_header')
All User
@endsection
@section('page_description')
A list of all the users
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('user') !!}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">User List</h3>
        </div>
        <div class="box-body"> 
          <table id="all_user_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Name</th>
                <th>Email</th> 
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody> 
          </table>
        </div>
      </div>
      <!-- /.box -->
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
       <button type="button" class="btn btn-danger" id="delete_user">Delete</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
     </div>
   </div>
   <!-- /. Modal content ends here -->
 </div>
</div>
<!--  Delete Customer Modal ends here -->
</div> 
@endsection





@section('scripts')
<!-- DataTables -->
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('document').ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })    
    var table = $('#all_user_table').DataTable({
     "paging": true,
     "lengthChange": true,
     "searching": true,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "processing": true,
     "serverSide": true,
     "ajax": "{{URL::to('/user/get_users')}}",
     "columns": [ 
     {"data": "name"},
     {"data": "email"}, 
     {data: 'action', name: 'action', orderable: false, searchable: false}
     ],
     "order": [[0, 'asc']]
   });  

// Delete User
$('#confirm_delete').on('show.bs.modal', function(e) {
 var $modal = $(this),
 user_id = e.relatedTarget.id;

 $('#delete_user').click(function(e){
   event.preventDefault();
   $.ajax({
     cache: false,
     type: 'DELETE',
     url: '/user/' + user_id,
     data: user_id,
     success: function(data){
       table.ajax.reload(null, false);
       $('#confirm_delete').modal('toggle');
     }
   });
 });
});

});   

</script>
@endsection