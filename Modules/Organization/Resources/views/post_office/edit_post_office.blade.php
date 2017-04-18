@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
@endsection
@section('page_header')
Post Office
@endsection
@section('page_description')
Set up Post Offices
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('post_office') !!}
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
                    <h3 class="box-title">Post Office Create</h3>
                </div> 
                {!! Form::open(array('route' => array('post_office.update', $post_office->id), 'id' => 'add_post_office_form', 'method'=>'PUT')) !!}                  
                <input type="hidden" name="post_office_id" id="post_office_id" value="{{$post_office->id}}">

                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('post_office_name')) has-error @endif">
                            <label for="name" class="control-label">Post Office Name*</label> 
                            <input type="text" class="form-control" id="post_office_name" name="post_office_name" placeholder="Enter name" value="{{$post_office->post_office_name}}"> 
                            @if ($errors->has('post_office_name')) <p class="help-block">{{ $errors->first('post_office_name') }}</p> @endif                             
                        </div>
                        <div class="form-group @if ($errors->has('postal_code')) has-error @endif">
                            <label for="name" class="control-label">Postal Code*</label> 
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code" value="{{$post_office->postal_code}}"> 
                            @if ($errors->has('postal_code')) <p class="help-block">{{ $errors->first('postal_code') }}</p> @endif                             
                        </div>                        
                        <div class="form-group @if ($errors->has('district_id')) has-error @endif">
                            <label for="district_id" class="control-label">District*</label>
                            <select class="js-example-basic-single js-states form-control" name="district_id" id="district_id"></select>
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
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Post Office List</h3>
            </div>
            <div class="box-body"> 
                <table id="all_role_table" class="table table-bordered table-hover">
                    <thead>
                      <tr> 
                        <th>Name</th> 
                        <th>Postal Code</th> 
                        <th>District</th> 
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
    $('#add_post_office_form').validate({
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
            post_office_name: {required: true, minlength: 4},
            postal_code: {required: true},
            district_id: {required: true}
        },
        messages: {
            post_office_name: {required: "Please give name"},
            postal_code: {required: "Please give a Code"},
            district_id: {required: "Please Enter District"}
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
     "ajax": "{{URL::to('/post_office/get_all_post_offices')}}",
     "columns": [ 
     {"data": "post_office_name"}, 
     {"data": "postal_code"}, 
     {"data": "district.district_name"}, 
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
       url: '/post_office/' + branch_id,
       data: branch_id,
       success: function(data){
         table.ajax.reload(null, false);
         $('#confirm_delete').modal('toggle');
     }
 });
 });
});

var district_id=$('#district_id');

// initialize select2 for post Office
$.get( "{{URL::to('/post_office/auto/get_district')}}", { post_office: $('#post_office_id').val() } ,function( data ) {
    init_select2_with_default_value({
        default_value: data,
        placeholder: "District",
        url: '{{URL::to("/")}}/branch/auto/get_branch_types',
        selector_id:district_id,
        data:{}
    });
});

});//document ready



</script>

@endsection
