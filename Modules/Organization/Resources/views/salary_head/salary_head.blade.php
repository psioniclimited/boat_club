@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
@endsection
@section('page_header')
Salary Head
@endsection
@section('page_description')
Set up Salary Head
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('salary_head') !!}
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
                    <h3 class="box-title">SalaryHead Create</h3>
                </div> 
                {!! Form::open(array('route'=>'salary_head.store','id'=>'add_salary_head_form','class' => 'form-horizontal')) !!}              
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('salary_head_name')) has-error @endif">
                            <label for="name" class="control-label">Salary Head Name*</label> 
                            <input type="text" class="form-control" id="salary_head_name" name="salary_head_name" placeholder="Enter name" value="{{old('salary_head_name')}}"> 
                            @if ($errors->has('salary_head_name')) <p class="help-block">{{ $errors->first('salary_head_name') }}</p> @endif                             
                        </div>
                        <div class="form-group @if ($errors->has('acc_code')) has-error @endif">
                            <label for="name" class="control-label">Acc Code</label> 
                            <input type="text" class="form-control" id="acc_code" name="acc_code" placeholder="Enter Address" value="{{old('acc_code')}}"> 
                            @if ($errors->has('acc_code')) <p class="help-block">{{ $errors->first('acc_code') }}</p> @endif                             
                        </div>

                        <div class="form-group @if ($errors->has('tax_type')) has-error @endif">
                            <label for="district_id" class="control-label">Tax Type*</label>
                            <select class="js-example-basic-single js-states form-control" name="tax_type" id="tax_type">
                                <option value="">Select</option>
                                <option value="1">Taxable</option>
                                <option value="0">Non Taxable</option>
                            </select>
                            @if ($errors->has('tax_type')) <p class="help-block">{{ $errors->first('tax_type') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('salary_head_type_id')) has-error @endif">
                            <label for="branch_id" class="control-label">Salary Head Type*</label>
                            <select class="js-example-basic-single js-states form-control" name="salary_head_type_id" id="salary_head_type_id">
                                <option value="">Select</option>
                                @foreach($salary_head_type as $type)
                                <option value="{{$type->id}}">{{$type->type_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('salary_head_type_id')) <p class="help-block">{{ $errors->first('salary_head_type_id') }}</p> @endif 
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
                <h3 class="box-title">Salary Head List</h3>
            </div>
            <div class="box-body"> 
                <table id="all_role_table" class="table table-bordered table-hover">
                    <thead>
                      <tr> 
                        <th>Salary Head Name</th> 
                        <th>Acc Code</th> 
                        <th>Tax Type</th> 
                        <th>Salary Head Type</th>  
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
    $('#add_salary_head_form').validate({
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
            salary_head_name: {required: true, minlength: 2},
            tax_type: {required: true},
            salary_head_type_id: {required: true}
        },
        messages: {
            salary_head_name: {required: "Please give name"},
            salary_head_type_id: {required: "Please Select a Head Type"},
            tax_type: {required: "Please Select a Tax Type"}
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
     "ajax": "{{URL::to('/salary_head/get_all_salary_heads')}}",
     "columns": [ 
     {"data": "salary_head_name"}, 
     {"data": "acc_code"}, 
     {"data": "tax_type"}, 
     {"data": "salary_head_type.type_name"},  
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
       url: '/salary_head/' + branch_id,
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
