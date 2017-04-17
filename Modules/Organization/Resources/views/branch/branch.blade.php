@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}"> 
@endsection
@section('page_header')
Branch
@endsection
@section('page_description')
Set up your Organization's Branches
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('branch') !!}
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
                    <h3 class="box-title">Branch Create</h3>
                </div>
                {!! Form::open(array('route'=>'branch.store','id'=>'add_branch_form','class' => 'form-horizontal')) !!}
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name" class="control-label">name*</label> 
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{old('name')}}"> 
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif                             
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <label for="description" class="control-label">Description</label> 
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="{{old('description')}}"> 
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('district_id')) has-error @endif">
                            <label for="district_id" class="control-label">District*</label>
                            <select class="js-example-basic-single js-states form-control" id="district_id"></select>
                            @if ($errors->has('district_id')) <p class="help-block">{{ $errors->first('district_id') }}</p> @endif 
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
                <h3 class="box-title">Role List</h3>
            </div>
            <div class="box-body"> 
                <table id="all_role_table" class="table table-bordered table-hover">
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
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>


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
    $('#add_branch_form').validate({
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
    var table = $('#all_role_table').DataTable({
       "paging": true,
       "lengthChange": true,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "processing": true,
       "serverSide": true,
       "ajax": "{{URL::to('/role/create')}}",
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

 $('#delete_role').click(function(e){
   event.preventDefault();
   $.ajax({
     cache: false,
     type: 'DELETE',
     url: '/role/' + user_id,
     data: user_id,
     success: function(data){
       table.ajax.reload(null, false);
       $('#confirm_delete').modal('toggle');
   }
});
});
});



//select2 for district
    var select_district = $('#district_id').select2({
      placeholder: "Select a District",
      allowClear: true,
      ajax: {
        dataType: 'json',
        url: "{{URL::to('/')}}/branch/get_districts",
        delay: 250,
        data: function(params) {
          return {
            term: params.term,
            page: params.page
          }
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
          return {
            results: data,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      }
    });
    select_roles.change(function(){ 
        var role_id=$(this).val();
      });// select role change




});//document ready



</script>

@endsection
