@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/iCheck/all.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
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
           <table id="all_salary_head_table" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Salary Head Name</th> 
                <th>Salary Head Type</th> 
                <th>Select</th> 
                <th>Amount</th>
                <th>Amount Type</th>
              </tr>
            </thead>
            <tbody>
              @foreach($salary_heads as $salary_head)
              <tr>
<!--                 <td>{{$salary_head->salary_head_name}}</td>
                <td>{{$salary_head->salary_head_type->type_name}}</td>
                <td>
                  <label>
                    <input type="checkbox" id="select[]" name="select[]" value="{{$salary_head->id}}" class="flat-red" checked>
                  </label>
                </td>
                <td>
                 <input type="number" class="form-control" id="amount_{{$salary_head->id}}" name="amount_{{$salary_head->id}}" placeholder="Enter Amount" value="0.0">  
               </td>
               <td>
                 <select class="form-control" name="amount_type_{{$salary_head->id}}" id="amount_type_{{$salary_head->id}}">
                   <option value="1">Taka</option>
                   <option value="0"> % of Basic Salary</option>
                 </select>
               </td> -->
               <td>{{$salary_head->salary_head_name}}</td>
               <td>{{$salary_head->salary_head_type->type_name}}</td>
               <td>
                <label>
                  <input type="checkbox" value="{{$salary_head->id}}" class="flat-red" >
                </label>
              </td>
              <td>
               <input type="number" class="form-control" placeholder="Enter Amount" value="0.0">  
             </td>
             <td>
              <select class="form-control">
                <option value="1">Taka</option>
                <option value="0"> % of Basic Salary</option>
              </select>
            </td>               
          </tr>
          @endforeach
        </tbody> 
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
















//array creation for post data

// var rows_selected = []; 
   var table = $('#all_salary_head_table').DataTable({
      // 'ajax': '/lab/jquery-datatables-checkboxes/ids-arrays.txt',
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
   });

// Handle click on table cells with checkboxes
$('#all_salary_head_table').on('click', 'tbody td, thead th:first-child', function(e){
  $(this).parent().find('input[type="checkbox"]').trigger('click');
});





 //   // Handle click on checkbox
 //   $('#all_salary_head_table tbody').on('click', 'input[type="checkbox"]', function(e){
 //     var $row = $(this);
 //     var index = $.inArray($row, rows_selected);

 //      // If checkbox is checked and row ID is not in list of selected row IDs
 //      if(this.checked && index === -1){
 //       rows_selected.push($row);

 //      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
 //    } else if (!this.checked && index !== -1){
 //     rows_selected.splice(index, 1);
 //   }

 //   if(this.checked){
 //     $row.addClass('selected');
 //   } else {
 //     $row.removeClass('selected');
 //   } 
 //   e.stopPropagation();
 // });

 //   $('#btn_submit').click(function() { 
 //    // console.log($('all_salary_head_table input, select').serialize());


 //    // $('#all_salary_head_table tr').filter(':has(:checkbox:checked)').each(function() {
 //    //   console.log($(this).val());
 //    //   $tr = $(this);

 //    //   $('td', $tr).each(function() {
 //    //     console.log($(this));
 //    //   });

 //    //   TableData[row]={
 //    //     "salary_head_id" : $(tr).find('td:eq(2)').text()
 //    //     , "amount" :$(tr).find('td:eq(3)').text()
 //    //     , "description" : $(tr).find('td:eq(2)').text()
 //    //     , "task" : $(tr).find('td:eq(3)').text()
 //    //   }

 //    // });
 //    // console.log(rows_selected);
 //    jQuery.each(rows_selected, function(index, item) {
 //    // do something with `item` (or `this` is also `item` if you like)

 //    var $row = item.closest('tr');
 //    var data = table.row($row);

 //    console.log(data);
 //  });
 //  });

   $('#btn_submit').click(function() { 
    // var rows_selected = table.column(2).checkboxes.selected();
    var rows_selected = table.column(2);
    console.log(rows_selected);
  });





});//document ready



</script>

@endsection
