@extends('layouts.master')
@section('css')  

<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.css">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="{{asset('editor_datatable/select2/css/select2.min.css')}}">

@endsection
@section('page_header')
{{$salary_grade_master->salary_grade_name}}
@endsection
@section('page_description')
Set up new Salary Grade
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('salary_grade') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Salary Grade Details</h3> -->
        </div>
        <div class="box-body"> 
        
          <div class="col-md-12"> 
          <button class="btn btn-xs btn-info pull-left" id="addRow">Add new row</button>  
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr> 
                  <th>Amount Type</th>
                  <th>Salary Head Name</th>
                  <th>Amount</th> 
                  <th>Action</th> 
                </tr>
              </thead>
              <tfoot>
                <tr> 
                  <th>Amount Type</th>
                  <th>Salary Head Name</th>
                  <th>Amount</th> 
                  <th>Action</th> 
                </tr>
              </tfoot>
            </table>
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer"> 
          <button type="submit" id="btn_submit" class="btn btn-primary pull-left">Submit</button>
        </div> <!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /col-md-6 -->
  </div>  <!--row-->
</section>
<!-- /.content -->


@endsection


@section('scripts')

<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.js"></script>
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
    });  
});//document ready


  $(document).ready(function() {
    var table = $('#example').DataTable();
    var counter = 1;

    $('#addRow').on( 'click', function () {
      table.row.add( [
        counter +'.1',
        counter +'.2',
        counter +'.3', 
        '<button class="btn btn-xs btn-danger pull-left deleteButton"  style="margin-left:10px">Delete row</button>', 
        ] ).draw( false );

      counter++;
    } );

    // Automatically add a first row of data
    $('#addRow').click();
    // $('#example tbody').on( 'click', 'tr', function () {
    //     if ( $(this).hasClass('selected') ) {
    //         $(this).removeClass('selected');
    //     }
    //     else {
    //         table.$('tr.selected').removeClass('selected');
    //         $(this).addClass('selected');
    //     }
    // } );
 
    $('body').on('click', '.deleteButton', function() {
      // alert("asd");
        $(this).parents("tr").remove(); 
    });    
} );



</script>

@endsection
