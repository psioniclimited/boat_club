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

    <!--  Permission List-->
    <div class="col-lg-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Loan Applications List</h3>
        </div>

        <div class="box-body"> 
          <table id="all_role_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Employee Information</th> 
                <th>Loan Type</th> 
                <th>Loan Amount</th>  
                <th>Status</th>
                <th>Required By Date</th> 
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
     "ajax": "{{URL::to('/loan_approval/get_all_loan_applications')}}",
     "columns": [  
     { 
      "data": "employee_fullname",
      "render": function ( data, type, full, meta ) { 
        var tag="";   
        tag='<h4 class="text-center">'+full.employee_code+'</h4><h4 class="text-center">'+data+'</h4>'
        return tag;
      }
    },
    {"data": "loan_type_name"},
    {"data": "loan_amount"},
    {"data": "loan_status_name"},
    {"data": "required_by_date"},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ], 
    "order": [[0, 'asc']]
  });  


});//document ready



</script>

@endsection
