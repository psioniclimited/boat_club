@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/iCheck/all.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">  
<style>

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
            <table id="all_salary_head_table" class="display table table-bordered table-hover">
              <thead>
                <tr> 
                  <th>Salary Head Name</th> 
                  <th>Salary Head Type</th>  
                  <th>Amount</th>
                  <th>Amount Type</th>
                </tr>
              </thead>
              <tbody>
<!--                 @foreach($salary_heads as $salary_head)
                <tr>

                 <td>
                   <input type="text" value="{{$salary_head->salary_head_name}}" class="form-control" name="{{$salary_head->id}}" readonly="">
                 </td>
                 <td>{{$salary_head->salary_head_type->type_name}}</td>
                 <td>
                   <input type="number" class="form-control" placeholder="Enter Amount" value="0.0">  
                 </td>
                 <td>
                  <select class="form-control" id="drop_down">
                    <option value="1">Taka</option>
                    <option value="0">% of Basic Salary</option>
                  </select>
                </td>               
              </tr>
              @endforeach -->
            </tbody> 
            <tfoot>
            <td><button>asd</button></td>
              
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
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>

  $(document).ready(function () {

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




    var table = $('#all_salary_head_table').DataTable();

    var selected_table_data = [];

    $('#all_salary_head_table tbody').on('click', 'tr', function () {
      $(this).toggleClass('selected'); 
    });



    $('#btn_submit').click(function() { 

        // var data = table.$('input, select').serialize();
        
       table.rows('.selected').data().each(function(){
        var data = $(this).$('input, select').serialize();
        console.log(
            "The following data would have been submitted to the server: \n\n"+
            data.substr( 0, 120 )+'...'
        );
       });

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



</script>

@endsection
