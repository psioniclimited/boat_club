@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css"> 
@endsection
@section('page_header')
Permission
@endsection
@section('page_description')
Register new permission
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('permission') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Permission Create</h3>
                </div>
                {!! Form::open(array('route' => array('permission.update', $permission->id), 'id' => 'edit_permission_form', 'method'=>'PUT')) !!}   
                <div class="box-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-login col-md-12">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="name" class="control-label">name*</label> 
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$permission->name}}"> 
                        </div>
                        <div class="form-group">
                            <label for="display_name" class="control-label">Display Name*</label> 
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Enter Display Name" value="{{$permission->display_name}}"> 
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label> 
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="{{$permission->description}}"> 
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
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Permission List</h3>
            </div>
            <div class="box-body"> 
                <table id="all_permission_table" class="table table-bordered table-hover">
                    <thead>
                      <tr> 
                        <th>Role Name</th>
                        <th>Display Name</th> 
                        <th>Role Description</th>
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
       <button type="button" class="btn btn-danger" id="delete_permission">Delete</button>
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
    $('#edit_permission_form').validate({
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
            name: {required: true, minlength: 4},
            display_name: {required: true, minlength: 4} 
        },
        messages: {
            name: {required: "Please give name"},
            display_name: {required: "Please give display name"}
        }
    });




    //Datatable Generation
    var table = $('#all_permission_table').DataTable({
       "paging": true,
       "lengthChange": true,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "processing": true,
       "serverSide": true,
       "ajax": "{{URL::to('/permission/create')}}",
       "columns": [ 
       {"data": "name"},
       {"data": "display_name"}, 
       {"data": "description"}, 
       {data: 'action', name: 'action', orderable: false, searchable: false}
       ],
       "order": [[0, 'asc']]
   });  







// Delete Permission
$('#confirm_delete').on('show.bs.modal', function(e) {
 var $modal = $(this),
 user_id = e.relatedTarget.id;

 $('#delete_permission').click(function(e){
   event.preventDefault();
   $.ajax({
     cache: false,
     type: 'DELETE',
     url: '/permission/' + user_id,
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
