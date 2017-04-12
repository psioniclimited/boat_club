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
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('document').ready(function(){
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
 });
</script>
@endsection