@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
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
                {!! Form::open(array('route' => array('branch.update', $branch->id), 'id' => 'add_branch_form', 'method'=>'PUT')) !!}                  
                <input type="hidden" name="branch_id" id="branch_id" value="{{$branch->id}}">
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('branch_name')) has-error @endif">
                            <label for="name" class="control-label">Name*</label> 
                            <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter name" value="{{$branch->branch_name}}"> 
                            @if ($errors->has('branch_name')) <p class="help-block">{{ $errors->first('branch_name') }}</p> @endif                             
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <label for="description" class="control-label">Description</label> 
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="{{$branch->description}}"> 
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('address')) has-error @endif">
                            <label for="description" class="control-label">Address*</label> 
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Description" value="{{$branch->address}}"> 
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif 
                        </div>                        
                        <div class="form-group @if ($errors->has('district_id')) has-error @endif">
                            <label for="district_id" class="control-label">District*</label>
                            <select class="js-example-basic-single js-states form-control" name="district_id" id="district_id"> 
                            </select>

                            @if ($errors->has('district_id')) <p class="help-block">{{ $errors->first('district_id') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('post_office_id')) has-error @endif">
                            <label for="district_id" class="control-label">Post Office*</label>
                            <select class="js-example-basic-single js-states form-control" name="post_office_id" id="post_office_id"></select>
                            @if ($errors->has('post_office_id')) <p class="help-block">{{ $errors->first('post_office_id') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('branch_type_id')) has-error @endif">
                            <label for="district_id" class="control-label">Branch Type*</label>
                            <select class="js-example-basic-single js-states form-control" name="branch_type_id" id="branch_type_id"></select>
                            @if ($errors->has('branch_type_id')) <p class="help-block">{{ $errors->first('branch_type_id') }}</p> @endif 
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Branch Type</th> 
                        <th>District</th>
                        <th>Post Office</th>
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
<script src="{{asset('js/utils/utils.js')}}"></script>


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
            branch_name: {required: true, minlength: 4},
            branch_type_id: {required: true},
            district_id: {required: true},
            post_office_id: {required: true},
            address: {required: true},
        },
        messages: {
            branch_name: {required: "Please give name"},
            branch_type_id: {required: "Please Select a Branch Type"},
            district_id: {required: "Please Select a District"},
            post_office_id: {required: "Please Select a Post Office"},
            address: {required: "Please Enter Address"}
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
     "ajax": "{{URL::to('/branch/get_all_branches')}}",
     "columns": [ 
     {"data": "branch_name"},
     {"data": "description"}, 
     {"data": "branch_type.branch_type_name"}, 
     {"data": "district.district_name"}, 
     {"data": "post_office.post_office_name"}, 
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
var district_id=$('#district_id');
var post_office_id=$('#post_office_id');
var branch_type_id=$('#branch_type_id');

// initialize select2 for district_id
$.get( "{{URL::to('/branch/auto/get_branch_district')}}", { branch_id: $('#branch_id').val() } ,function( data ) {
    init_select2_with_default_value({
        default_value: data,
        placeholder: "District",
        url: '{{URL::to("/")}}/branch/auto/get_districts',
        selector_id:district_id,
        data:{}
    });
});


// initialize select2 for post Office
$.get( "{{URL::to('/branch/auto/get_branch_post_office')}}", { branch_id: $('#branch_id').val() } ,function( data ) {
    init_select2_with_default_value_with_one_parameter({
        default_value: data,
        placeholder: "Post Office",
        url: '{{URL::to("/")}}/branch/auto/get_post_offices',
        selector_id:post_office_id,
        data:{},
        value_id:district_id
    });
});


// initialize select2 for post Office
$.get( "{{URL::to('/branch/auto/get_branch_branch_type')}}", { branch_id: $('#branch_id').val() } ,function( data ) {
    init_select2_with_default_value({
        default_value: data,
        placeholder: "District",
        url: '{{URL::to("/")}}/branch/auto/get_branch_types',
        selector_id:branch_type_id,
        data:{}
    });
});


$('#district_id').change(function(){  
      $(this).valid(); // trigger validation on this element
      $('#post_office_id').select2("val","");  
  });

$('#post_office_id').change(function(){  
      $(this).valid(); // trigger validation on this element
  });

$('#branch_type_id').change(function(){  
      $(this).valid(); // trigger validation on this element
  });




});//document ready



</script>

@endsection
