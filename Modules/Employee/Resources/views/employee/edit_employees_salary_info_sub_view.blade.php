                    
<?php $employee_salary_info=$employee->employee_job_info[0]->employee_salary_information[0];?>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('salary_grade_master_id')) has-error @endif">
    <label for="name" class="control-label">Salary Grade*</label>
    <select class="form-control" id="salary_grade_master_id" name="salary_grade_master_id" > 
    </select>                 
    @if ($errors->has('salary_grade_master_id')) <p class="help-block">{{ $errors->first('salary_grade_master_id') }}</p> @endif                             
  </div> 
</div><!-- /.col-md-6 -->


<div class="col-md-6">  
  <div class="form-group @if ($errors->has('basic_salary')) has-error @endif">  
    <label for="name" class="control-label">Basic Salary (If defferent from Salary Grade) </label> 
    <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Basic Salary" value="{{$employee_salary_info->basic_salary}}"> 
    @if ($errors->has('basic_salary')) <p class="help-block">{{ $errors->first('basic_salary') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->
<div class="col-md-12"></div>

<div class="col-md-6">  
  <div class="form-group @if ($errors->has('hourly_pay_rate')) has-error @endif">  
    <label for="name" class="control-label">Hourly Pay Rate</label> 
    <input type="number" class="form-control" id="hourly_pay_rate" name="hourly_pay_rate" placeholder="Hourly Pay Rate" value="{{$employee_salary_info->hourly_pay_rate}}"> 
    @if ($errors->has('hourly_pay_rate')) <p class="help-block">{{ $errors->first('hourly_pay_rate') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->


<div class="col-md-6">  
  <div class="form-group @if ($errors->has('overtime_rate')) has-error @endif">  
    <label for="name" class="control-label">OverTime Rate</label> 
    <input type="number" class="form-control" id="overtime_rate" name="overtime_rate" placeholder="Overtime Pay Rate" value="{{$employee_salary_info->overtime_rate}}"> 
    @if ($errors->has('overtime_rate')) <p class="help-block">{{ $errors->first('overtime_rate') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->

<div class="col-md-6">  
  <div class="form-group @if ($errors->has('weekly_overtime_hour_limit')) has-error @endif">  
    <label for="name" class="control-label">Weekly Overtime Limit</label> 
    <input type="number" class="form-control" id="weekly_overtime_hour_limit" name="weekly_overtime_hour_limit" placeholder="Overtime Limit (Hour)" value="{{$employee_salary_info->weekly_overtime_hour_limit}}"> 
    @if ($errors->has('weekly_overtime_hour_limit')) <p class="help-block">{{ $errors->first('weekly_overtime_hour_limit') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->

<div class="col-md-12"></div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('payment_mode_id')) has-error @endif">
    <label for="name" class="control-label">Payment Mode*</label>
    <select class="form-control" id="payment_mode_id" name="payment_mode_id" > 
      @foreach($payment_modes as $row)
      @if($row->id==$employee_salary_info->payment_mode_id)
      <option value="{{$row->id}}" selected="">{{$row->payment_mode_name}}</option>  
      @else
      <option value="{{$row->id}}">{{$row->payment_mode_name}}</option>  
      @endif
      @endforeach 
    </select>                 
    @if ($errors->has('payment_mode_id')) <p class="help-block">{{ $errors->first('payment_mode_id') }}</p> @endif                             
  </div> 
</div><!-- /.col-md-6 -->

<div class="col-md-12"></div>

<div class="col-md-6">  
  <div class="form-group @if ($errors->has('employee_bank_name')) has-error @endif">  
    <label for="name" class="control-label">Employee's Bank Name</label> 
    <input type="text" class="form-control" id="employee_bank_name" name="employee_bank_name" placeholder="Employee Bank Name" value="{{$employee_salary_info->employee_bank_name}}"> 
    @if ($errors->has('employee_bank_name')) <p class="help-block">{{ $errors->first('employee_bank_name') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->
<div class="col-md-6">  
  <div class="form-group @if ($errors->has('employee_bank_branch')) has-error @endif">  
    <label for="name" class="control-label">Employee's Bank Branch</label> 
    <input type="text" class="form-control" id="employee_bank_branch" name="employee_bank_branch" placeholder="Employee's Bank Branch'" value="{{$employee_salary_info->employee_bank_branch}}"> 
    @if ($errors->has('employee_bank_branch')) <p class="help-block">{{ $errors->first('employee_bank_branch') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->
<div class="col-md-6">  
  <div class="form-group @if ($errors->has('employee_bank_acc')) has-error @endif">  
    <label for="name" class="control-label">Employee's Bank Account No.</label> 
    <input type="text" class="form-control" id="employee_bank_acc" name="employee_bank_acc" placeholder="Employee's Bank Account'" value="{{$employee_salary_info->employee_bank_acc}}"> 
    @if ($errors->has('employee_bank_acc')) <p class="help-block">{{ $errors->first('employee_bank_acc') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->
<div class="col-md-12"></div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('final_leave_encashed')) has-error @endif">
    <label for="name" class="control-label">Final Leave Encahed*</label>
    <select class="form-control" id="final_leave_encashed" name="final_leave_encashed" > 
      @if($employee_salary_info->final_leave_encashed==1) 
      <option value="1">Yes</option>
      <option value="2">No</option>
      @else
      <option value="2">No</option>
      <option value="1">Yes</option>
      @endif
    </select>                 
    @if ($errors->has('final_leave_encashed')) <p class="help-block">{{ $errors->first('final_leave_encashed') }}</p> @endif                             
  </div> 
</div><!-- /.col-md-6 -->
<div class="col-md-6">  
  <div class="form-group @if ($errors->has('final_leave_encashed_date')) has-error @endif">  
    <label for="name" class="control-label">Final Leave Encashed Date</label> 
    <input type="text" class="form-control" id="final_leave_encashed_date" name="final_leave_encashed_date" placeholder="Leave Encashed Date'" value="{{$employee_salary_info->final_leave_encashed_date}}" data-date-format='yyyy-mm-dd'> 
    @if ($errors->has('final_leave_encashed_date')) <p class="help-block">{{ $errors->first('final_leave_encashed_date') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->             
