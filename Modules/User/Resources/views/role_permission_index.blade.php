@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}"> 
@endsection
@section('page_header')
Role Permission
@endsection
@section('page_description')
Initialize permissions to role
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('role_permission') !!}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
<!--   <div class="row">
    <div class="col-md-4"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Select a Role</h3>
        </div>
        <div class="box-body"> 
          <select class="js-example-basic-single js-states form-control" id="roles"></select>
        </div>
      </div> 
    </div>
  </div> -->
  <div class="row">

    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Set Permissions</h3>
        </div>
        <div class="box-body"> 
          
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>    
</section>
<!-- /.content -->

</div> 
@endsection





@section('scripts')
<!-- DataTables -->
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>

<script>
  $('document').ready(function(){    
    // var select_roles = $('#roles').select2({
    //   placeholder: "Select a Role",
    //   allowClear: true,
    //   ajax: {
    //     dataType: 'json',
    //     url: "{{URL::to('/')}}/role_permission/get_roles",
    //     delay: 250,
    //     data: function(params) {
    //       return {
    //         term: params.term,
    //         page: params.page
    //       }
    //     },
    //     processResults: function (data, params) {
    //       params.page = params.page || 1;
    //       return {
    //         results: data,
    //         pagination: {
    //           more: (params.page * 30) < data.total_count
    //         }
    //       };
    //     },
    //     cache: true
    //   }
    // });
    // select_roles.change(function(){ 
    //     var role_id=$(this).val();
    //   });// select role change



  });   //document ready

</script>
@endsection