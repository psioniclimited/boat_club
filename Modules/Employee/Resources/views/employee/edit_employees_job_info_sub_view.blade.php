                   <?php $employee_job_info=$employee->employee_job_info[0] ;?>


                   <div class="col-md-6">  
                     <div class="form-group @if ($errors->has('offer_date')) has-error @endif">  
                      <label for="name" class="control-label">Offer Date</label> 
                      <input type="text" class="form-control" id="offer_date" name="offer_date" placeholder="Offer Date" value="{{$employee_job_info->offer_date}}" data-date-format='yyyy-mm-dd'> 
                      @if ($errors->has('offer_date')) <p class="help-block">{{ $errors->first('offer_date') }}</p> @endif                             
                    </div>
                  </div><!-- /.col-md-6 -->

                  <div class="col-md-6">  
                   <div class="form-group @if ($errors->has('confirmation_date')) has-error @endif">  
                    <label for="name" class="control-label">Confirmation Date</label> 
                    <input type="text" class="form-control" id="confirmation_date" name="confirmation_date" placeholder="Confirmation Date" value="{{ $employee_job_info->confirmation_date}}" data-date-format='yyyy-mm-dd'> 
                    @if ($errors->has('confirmation_date')) <p class="help-block">{{ $errors->first('confirmation_date') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">  
                  <div class="form-group @if ($errors->has('date_of_joining')) has-error @endif">  
                    <label for="name" class="control-label">Date Of Joining</label> 
                    <input type="text" class="form-control" id="date_of_joining" name="date_of_joining" placeholder="Joining Date" value="{{$employee_job_info->date_of_joining}}" data-date-format='yyyy-mm-dd'> 
                    @if ($errors->has('date_of_joining')) <p class="help-block">{{ $errors->first('date_of_joining') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">  
                  <div class="form-group @if ($errors->has('retirement_date')) has-error @endif">  
                    <label for="name" class="control-label">Retirement Date</label> 
                    <input type="text" class="form-control" id="retirement_date" name="retirement_date" placeholder="Retirement Date" value="{{$employee_job_info->retirement_date}}" data-date-format='yyyy-mm-dd'> 
                    @if ($errors->has('retirement_date')) <p class="help-block">{{ $errors->first('retirement_date') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">  
                  <div class="form-group @if ($errors->has('contract_end_date')) has-error @endif">  
                    <label for="name" class="control-label">Contract End Date</label> 
                    <input type="text" class="form-control" id="contract_end_date" name="contract_end_date" placeholder="Contract End Date" value="{{$employee_job_info->contract_end_date}}" data-date-format='yyyy-mm-dd'> 
                    @if ($errors->has('contract_end_date')) <p class="help-block">{{ $errors->first('contract_end_date') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->


                <div class="col-md-12"></div>

                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('employment_type_id')) has-error @endif">
                    <label for="name" class="control-label">Employment Type*</label>
                    <select class="form-control" id="employment_type_id" name="employment_type_id" > 
                      @foreach($employment_types as $row)
                      @if($row->id==$employee_job_info->employment_type_id)
                      <option value="{{$row->id}}" selected="">{{$row->employment_type_name}}</option>  
                      @else 
                      <option value="{{$row->id}}">{{$row->employment_type_name}}</option>  
                      @endif 
                      @endforeach 
                    </select>                 
                    @if ($errors->has('department_branch_id')) <p class="help-block">{{ $errors->first('department_branch_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->

                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('department_branch_id')) has-error @endif">
                    <label for="name" class="control-label">Posting Branch*</label>
                    <select class="form-control" id="department_branch_id" name="department_branch_id" > 
                    </select>                 
                    @if ($errors->has('department_branch_id')) <p class="help-block">{{ $errors->first('department_branch_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->

                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('department_id')) has-error @endif">
                    <label for="name" class="control-label">Posting Department*</label>
                    <select class="form-control" id="department_id" name="department_id" > 
                    </select>                 
                    @if ($errors->has('department_id')) <p class="help-block">{{ $errors->first('department_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->


                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('designation_id')) has-error @endif">
                    <label for="name" class="control-label">Designation*</label>
                    <select class="form-control" id="designation_id" name="designation_id" > 
                    </select>                 
                    @if ($errors->has('designation_id')) <p class="help-block">{{ $errors->first('designation_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->
                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('work_shift_id')) has-error @endif">
                    <label for="name" class="control-label">Work Shift*</label>
                    <select class="form-control" id="work_shift_id" name="work_shift_id" > 
                    </select>                 
                    @if ($errors->has('work_shift_id')) <p class="help-block">{{ $errors->first('work_shift_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->

                <div class="col-md-12"></div>

                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('holiday_list_id')) has-error @endif">
                    <label for="name" class="control-label">Holiday List*</label>
                    <select class="form-control" id="holiday_list_id" name="holiday_list_id" > 
                    </select>                 
                    @if ($errors->has('holiday_list_id')) <p class="help-block">{{ $errors->first('holiday_list_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->

                <div class="col-md-6"> 
                  <div class="form-group @if ($errors->has('week_holiday_master_id')) has-error @endif">
                    <label for="name" class="control-label">Week Holiday*</label>
                    <select class="form-control" id="week_holiday_master_id" name="week_holiday_master_id" > 
                    </select>                 
                    @if ($errors->has('week_holiday_master_id')) <p class="help-block">{{ $errors->first('week_holiday_master_id') }}</p> @endif                             
                  </div> 
                </div><!-- /.col-md-6 -->



                <div class="col-md-6">  
                  <div class="form-group @if ($errors->has('company_email')) has-error @endif">  
                    <label for="name" class="control-label">Company Email</label> 
                    <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="{{$employee_job_info->company_email}}" > 
                    @if ($errors->has('company_email')) <p class="help-block">{{ $errors->first('company_email') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->


                <div class="col-md-6">  
                  <div class="form-group @if ($errors->has('notice_day')) has-error @endif">  
                    <label for="name" class="control-label">Notice Day</label> 
                    <input type="text" class="form-control" id="notice_day" name="notice_day" placeholder="Notice Day" value="{{$employee_job_info->notice_day}}" > 
                    @if ($errors->has('notice_day')) <p class="help-block">{{ $errors->first('notice_day') }}</p> @endif                             
                  </div>
                </div><!-- /.col-md-6 -->
