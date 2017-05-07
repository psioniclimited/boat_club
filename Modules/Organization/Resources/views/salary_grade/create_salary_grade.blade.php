@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/iCheck/all.css')}}"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.14/css/dataTables.bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
<!-- <link rel="stylesheet" href="{{asset('editor_datatable')}}/css/editor.bootstrap.css">   -->
<link rel="stylesheet" href="{{asset('editor_datatable')}}/css/dataTables.editor.css">  
<link rel="stylesheet" href="{{asset('editor_datatable/select2/css/select2.min.css')}}">


<style>
  div.modal-dialog {
    left: 1em !important;
    right: 1em !important;
    margin-left: 0 !important;
    width: auto !important;
  }
</style>
@endsection
@section('page_header')
Salary Grade
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
    <!-- {!! Form::open(array('route'=>'salary_grade.store','id'=>'add_salary_grade_form','class' => 'form-horizontal')) !!} -->
    <div class="col-md-8"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Salary Grade Create</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12"> 

            <div class="form-group @if ($errors->has('salary_grade_name')) has-error @endif">
              <label for="name" class="control-label">Salary Grade Name*</label> 
              <input type="text" class="form-control" id="salary_grade_name" name="salary_grade_name" placeholder="Enter name" value="{{old('salary_grade_name')}}"> 
              @if ($errors->has('salary_grade_name')) <p class="help-block">{{ $errors->first('salary_grade_name') }}</p> @endif                             
            </div> 
            <div class="form-group @if ($errors->has('basic_salary')) has-error @endif">
              <label for="name" class="control-label">Base Salary*</label> 
              <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Enter Base Salary" value="{{old('basic_salary')}}"> 
              @if ($errors->has('basic_salary')) <p class="help-block">{{ $errors->first('basic_salary') }}</p> @endif                             
            </div> 
          </div><!-- /.col-md-12 -->
        </div> <!-- /.box-body --> 
        <div class="box-footer">  
        </div> <!-- /.box-footer -->

      </div><!-- /.box -->
    </div><!-- /col-md-6 -->







    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Salary Grade Details</h3>
        </div>
        <div class="box-body">
          <div class="col-md-12"> 
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Amount Type1</th>
                  <th>Amount Type</th>
                  <th>Salary Head Name</th>
                  <th>Amount</th> 
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Amount Type1</th>
                  <th>Amount Type</th>
                  <th>Salary Head Name</th>
                  <th>Amount</th> 
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






    <!-- {!! Form::close() !!}     -->
  </div>  <!--row-->
</section>
<!-- /.content -->


@endsection


@section('scripts')
<!-- <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"> -->
<!-- </script> -->

<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>

<!-- <script type="text/javascript" language="javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> -->
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.14/js/dataTables.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js">
</script>


<script src="{{asset('editor_datatable')}}/js/dataTables.editor.js"></script>
<script src="{{asset('editor_datatable')}}/js/editor.bootstrap.min.js"></script>

<!-- <script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script> -->

<!-- <script src="{{asset('editor_datatable')}}/js/editor.bootstrap.min.js"></script> -->
<script src="{{asset('editor_datatable')}}/select2/js/select2.min.js"></script>
<script src="{{asset('editor_datatable')}}/select2/editor.select2.js"></script>
<script src="{{asset('js/utils/utils.js')}}"></script>

<script>



  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });  
    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });




    // initialize validate plugin on the form
    $('#add_salary_grade_form').validate({
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
        salary_grade_name: {required: true, minlength: 4},
        basic_salary: {required: true} 
      },
      messages: {
        salary_grade_name: {required: "Please give name"},
        basic_salary: {required: "Please Enter Basic Salary"}
      }
    });




    // var table = $('#all_salary_head_table').DataTable();

    // var selected_table_data = [];

    // $('#all_salary_head_table tbody').on('click', 'tr', function () {
    //   $(this).toggleClass('selected'); 
    // });



    $('#btn_submit').click(function() { 

        // var data = table.$('input, select').serialize();
        
        // table.rows('.selected').data().each(function(){
        //   var data = $(this).$('input, select').serialize();
        //   console.log(
        //     "The following data would have been submitted to the server: \n\n"+
        //     data.substr( 0, 120 )+'...'
        //     );
        // });

      // var ids = $.map(table.rows('.selected').data(), function (item) { 
      //   json = {};
      //   json["salary_head_id"]= $(item[0]).html(item[0]).contents().attr('name');
      //   json["amount"]= $(item[2]).html(item[2]).contents().val();
      //   json["amount_type"]= $(item[3]).html(item[3]).contents().val();

      //   console.log($(item[3]).html(item[3]).contents());
      //   // return $(item[3]).html(item[3]).contents().val();
      //   return $(item[3]).html(item[3]).contents("#drop_down option:selected").val();
      //   selected_table_data.push(json);

      // });
      // console.log(ids);
      // console.log(selected_table_data);

    });




});//document ready







var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {

  $.extend( true, $.fn.dataTable.Editor.classes, {
    "field": {
      "wrapper": "col-lg-4",
      "label":   "col-lg-12",
      "input":   "col-lg-12"
    }
  } );

  editor = new $.fn.dataTable.Editor( {
    // ajax: "{{URL::to("/")}}/salary_grade/validate_table",
    table: "#example",
    fields: [
    {
      label: "Foo:",
      name: "asdf.amount_type1",
      "type": "select2",

      opts: {
       ajax: {
        dataType: "json",
        url: "{{URL::to("/")}}/branch/auto/get_branchs",

        data: function(params) {
          return {
            term: params.term || '',
            page: params.page || 1
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
      },
    }
  }

  ]
} );

  var table = $('#example').DataTable( {
    lengthChange: false,
    // ajax: "https://api.myjson.com/bins/t95m1",
    columns: [
    { data: 'asdf',editField: "amount.amount_type1",
      render:function(val,type,key){
        console.log(key);
    }
  },    
  {
    "class": "center",
    "data": "amount_type",
    "render": function (val, type, row) {
      return val == 0 ? " % of Basic Salary" : "Taka";
    }
  }, 
  { data: "salary_head_id" }, 
  { data: "amount" }, 
  ],
  select: true
} );







  // Display the buttons
  new $.fn.dataTable.Buttons( table, [
    { extend: "create", editor: editor },
    { extend: "edit",   editor: editor },
    { extend: "remove", editor: editor }
    ] );

  table.buttons().container()
  .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

































  editor.add( {
    label: "Amount Type:",
    name: "amount_type",
    type: "select",
    options: [
    { "label": "Taka", "value": "1" },
    { "label": "% of Basic Salary",  "value": "0" }
    ]
  } ); 

  editor.add( {
    label: "Salary Head Name",
    name: "salary_head_id",
    type:"select2",
    opts:{ 
      allowClear: true,
      placeholder: "Select Salary Head",
      ajax: {
        dataType: 'json',
        url: '{{URL::to("/")}}/branch/auto/get_districts',
        delay: 250,
        data: function(params) {
          return {
            term: params.term, 
            page: params.page, 
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
    }
  } );

  editor.add( {
    label: "Amount: ",
    name: "amount",
    attr: {
      type: "number"
    }
  } );  





} );




</script>

@endsection
