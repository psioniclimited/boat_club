@extends('layouts.master')
@section('css')  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<style>
  img{
    margin-left: auto;
    margin-right:auto;
  }
</style>
@endsection
@section('page_header')
Employee
@endsection
@section('page_description')
List of employees
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('employee') !!}
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
          <h3 class="box-title">Employee List</h3>
        </div>

        <div class="box-body"> 
          <table id="all_role_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Employee Information</th> 
                <th>Employee Image</th> 
                <th>Branch</th>  
                <th>Department</th>
                <th>Designation</th>
                <th>Contact No.</th>
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
     "ajax": "{{URL::to('/employee/get_all_employees')}}",
     "columns": [  
     { 
      "data": "employee_fullname",
      "render": function ( data, type, full, meta ) { 
        var tag="";
        tag='<h4 class="text-center">'+full.employee_series.employee_series_name+'</h4><h4 class="text-center">'+full.employee_code+'</h4><h4 class="text-center">'+full.employee_fullname+'</h4>'
        return tag;
      }
    },
    { 
      "data": "employee_image",
      "render": function ( data, type, full, meta ) {
        // console.log( full.employee_job_info[0].date_of_joining);
        var tag="";
        // console.log( full);
        if (data!="") {
          tag='<img src="uploads/employee_emage/"'+data +'class="img-responsive" height="150px" width="150px">';
        }else{
          tag='<img src="http://via.placeholder.com/150x150" class="text-centered img-responsive" height="150px" width="100px">';
        } 
        return tag;
      }
    }, 

    {"data": "employee_job_info[0].department.branch.branch_name"}, 
    {"data": "employee_job_info[0].department.department_name"},  
    {"data": "employee_job_info[0].designation.designation_name"}, 
    {"data": "contact_number"}, 
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
   url: '/employee/' + branch_id,
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
