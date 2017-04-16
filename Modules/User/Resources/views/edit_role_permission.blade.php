@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}"> 
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/iCheck/all.css')}}">
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
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">{{$role->name}}</h3>
        </div>
        <div class="box-body"> 
          {!! Form::open(array('route' => array('role_permission.update', $role->id), 'id' => 'edit_role_permission_form', 'method'=>'PUT')) !!}             
          @foreach($permissions as $permission)
          <div class="col-md-3">
            <!-- checkbox -->
            <div class="form-group">
              <label>
                @if($role->perms->isEmpty())
                <input name="permissions[]" type="checkbox" class="minimal" value="{{$permission->id}}">
                @else 
                @if($role->perms->contains( $permission->id))
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="minimal" checked> 
                @else
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="minimal"> 
                @endif 
                @endif
                {{$permission->name}}
              </label>
            </div>
          </div>
          @endforeach
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
        {!! Form::close() !!}
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
<script src="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>

<script>
  $('document').ready(function(){    
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });   //document ready

</script>
@endsection