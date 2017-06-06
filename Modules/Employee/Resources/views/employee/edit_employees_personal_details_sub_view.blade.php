<!-- <center></center> -->
<div class="col-md-6">  
  <div class="form-group @if ($errors->has('employee_image')) has-error @endif">
    @if($employee->employee_image!=NULL)
    <img src=" {{asset('uploads/employee_image/'.$employee->employee_image)}}" height="250px"  width="220px" id="employee_image_preview" alt="">
    @else
    <img src=" http://placehold.it/220x250" height="250px"  width="220px" id="employee_image_preview" alt="">
    @endif
    <br>
    <label for="name" class="control-label">Employee Image</label> 
    <input type="file" id="employee_image" name="employee_image" placeholder="Select Image" value="{{old('employee_image')}}"  onchange="previewImage(event)"> 
    @if ($errors->has('employee_image')) <p class="help-block">{{ $errors->first('employee_image') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->

<div class="col-md-6">  
  <div class="form-group @if ($errors->has('employee_series_id')) has-error @endif">
    <label for="name" class="control-label">Employee Series*</label>
    <select class="form-control" id="employee_series_id" name="employee_series_id">
      @foreach($employee_serieses as $row)
      @if($row->id==$employee->employee_series_id)
      <option value="{{$row->id}}" selected="">{{$row->employee_series_name}}</option>  
      @else 
      <option value="{{$row->id}}">{{$row->employee_series_name}}</option>  
      @endif
      @endforeach 
    </select>   
    @if ($errors->has('employee_series_id')) <p class="help-block">{{ $errors->first('employee_series_id') }}</p> @endif                             
  </div>

  <div class="form-group @if ($errors->has('employee_code')) has-error @endif">
    <label for="name" class="control-label">Eployee Code*</label> 
    <input type="text" class="form-control" id="employee_code" name="employee_code" placeholder="Enter Applicant Code" value="{{$employee->employee_code}}" > 
    @if ($errors->has('employee_code')) <p class="help-block">{{ $errors->first('employee_code') }}</p> @endif                             
  </div>

  <div class="form-group @if ($errors->has('can_login')) has-error @endif">
    <label for="name" class="control-label">Generate Login Information</label> 
    <div class="checkbox">

      <label>
        @if($employee->can_login==1) 
        <input type="checkbox" class="minimal" name="can_login" id="can_login" value="1" checked=""> Generate
        @else
        <input type="checkbox" class="minimal" name="can_login" id="can_login" value="1"> Generate 
        @endif
      </label>
    </div>
    @if ($errors->has('can_login')) <p class="help-block">{{ $errors->first('can_login') }}</p> @endif                             
  </div>
</div><!-- /.col-md-6 -->

<!-- <div class="col-md-12"> -->
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('salutation_id')) has-error @endif">
    <label for="name" class="control-label">Salutation*</label>
    <select class="form-control" id="salutation_id" name="salutation_id">
      @foreach($salutations as $row)
      @if($row->id==$employee->employee_series_id)
      <option value="{{$row->id}}" selected="">{{$row->salutation_name}}</option>  
      @else 
      <option value="{{$row->id}}">{{$row->salutation_name}}</option>  
      @endif 
      @endforeach 
    </select>   
    @if ($errors->has('salutation_id')) <p class="help-block">{{ $errors->first('salutation_id') }}</p> @endif                             
  </div>
</div>

<div class="col-md-6"></div> 
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('employee_fullname')) has-error @endif">
    <label for="name" class="control-label">Full Name*</label> 
    <input type="text" class="form-control" id="employee_fullname" name="employee_fullname" placeholder="Enter Full Name" value="{{$employee->employee_fullname}}" >                           
    @if ($errors->has('employee_fullname')) <p class="help-block">{{ $errors->first('employee_fullname') }}</p> @endif                             
  </div>
</div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('personal_email')) has-error @endif">
    <label for="name" class="control-label">Personal Email</label> 
    <input type="text" class="form-control" id="personal_email" name="personal_email" placeholder="Employee's Personal Email" value="{{$employee->personal_email}}" >                           
    @if ($errors->has('personal_email')) <p class="help-block">{{ $errors->first('personal_email') }}</p> @endif                             
  </div>
</div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('contact_number')) has-error @endif">
    <label for="name" class="control-label">Personal Contact Number</label> 
    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Employee's Personal Contact" value="{{$employee->contact_number}}" >                           
    @if ($errors->has('contact_number')) <p class="help-block">{{ $errors->first('contact_number') }}</p> @endif                             
  </div>
</div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('date_of_birth')) has-error @endif">
    <label for="name" class="control-label">Date Of Birth*</label> 
    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Employee's Date Of Birth" value="{{$employee->date_of_birth}}" data-date-format='yyyy-mm-dd'>                           
    @if ($errors->has('date_of_birth')) <p class="help-block">{{ $errors->first('date_of_birth') }}</p> @endif                             
  </div>
</div>
<div class="col-md-12"></div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('passport')) has-error @endif">
    <label for="name" class="control-label">Passport</label> 
    <input type="text" class="form-control" id="passport" name="passport" placeholder="Employee's Passport Number" value="{{$employee->passport}}" >                           
    @if ($errors->has('passport')) <p class="help-block">{{ $errors->first('passport') }}</p> @endif                             
  </div>
</div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('passport_issue_place')) has-error @endif">
    <label for="name" class="control-label">Passport Issue Place</label> 
    <input type="text" class="form-control" id="passport_issue_place" name="passport_issue_place" placeholder="Employee's Passport Issue Place" value="{{$employee->passport_issue_place}}" >                           
    @if ($errors->has('passport_issue_place')) <p class="help-block">{{ $errors->first('passport_issue_place') }}</p> @endif                             
  </div>
</div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('passport_issue_date')) has-error @endif">
    <label for="name" class="control-label">Passport Issue Date</label> 
    <input type="text" class="form-control" id="passport_issue_date" name="passport_issue_date" placeholder="Employee's Passport Issue Date" value="{{$employee->passport_issue_date}}" data-date-format='yyyy-mm-dd'>                           
    @if ($errors->has('passport_issue_date')) <p class="help-block">{{ $errors->first('passport_issue_date') }}</p> @endif                             
  </div>
</div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('passport_valid_upto')) has-error @endif">
    <label for="name" class="control-label">Passport Valid Upto</label> 
    <input type="text" class="form-control" id="passport_valid_upto" name="passport_valid_upto" placeholder="Employee's Passport Valid Upto" value="{{$employee->passport_valid_upto}}" data-date-format='yyyy-mm-dd'>                           
    @if ($errors->has('passport_valid_upto')) <p class="help-block">{{ $errors->first('passport_valid_upto') }}</p> @endif                             
  </div>
</div>

<div class="col-lg-12"></div>

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('marital_status_id')) has-error @endif">
    <label for="name" class="control-label">Marital Status</label>
    <select class="form-control" id="marital_status_id" name="marital_status_id">

      @foreach($marital_statuses as $row)
      @if($row->id==$employee->marital_status_id)
      <option value="{{$row->id}}" selected="">{{$row->marital_status_name}}</option>   
      @else 
      <option value="{{$row->id}}">{{$row->marital_status_name}}</option>  
      @endif 
      @endforeach 
    </select>   
    @if ($errors->has('marital_status_id')) <p class="help-block">{{ $errors->first('marital_status_id') }}</p> @endif                             
  </div>
</div> 

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('religion_id')) has-error @endif">
    <label for="name" class="control-label">Religion*</label>
    <select class="form-control" id="religion_id" name="religion_id">
      @foreach($religions as $row)
      @if($row->id==$employee->religion_id)
      <option value="{{$row->id}}" selected="">{{$row->religion_name}}</option>  
      @else 
      <option value="{{$row->id}}">{{$row->religion_name}}</option>  
      @endif 
      @endforeach                  
    </select>   
    @if ($errors->has('religion_id')) <p class="help-block">{{ $errors->first('religion_id') }}</p> @endif                             
  </div>
</div>  

<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('blood_group_id')) has-error @endif">
    <label for="name" class="control-label">Blood Group</label>
    <select class="form-control" id="blood_group_id" name="blood_group_id">
      @foreach($blood_groups as $row)
      @if($row->id==$employee->blood_group_id)
      <option value="{{$row->id}}" selected="">{{$row->blood_group_name}}</option>  
      @else 
      <option value="{{$row->id}}">{{$row->blood_group_name}}</option>  
      @endif 
      @endforeach    
    </select>   
    @if ($errors->has('blood_group_id')) <p class="help-block">{{ $errors->first('blood_group_id') }}</p> @endif                             
  </div>
</div>

<div class="col-md-12">
  <label for="name" class="control-label">Employee Bio</label>
  <div class="box-body pad"> 
    <textarea name="bio" id="bio" class="textarea" placeholder="Bio For Websites" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea> 
  </div> 
</div>   
<div class="col-md-6">
  <div class="form-group @if ($errors->has('present_address')) has-error @endif">
    <label for="name" class="control-label">Present Address</label>
    <div class="box-body pad"> 
      <textarea name="present_address" id="present_address" class="textarea" placeholder="Present Address" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$employee->present_address}}</textarea> 
    </div> 
    @if ($errors->has('present_address')) <p class="help-block">{{ $errors->first('present_address') }}</p> @endif                          
  </div>
</div>
<div class="col-md-6">
  <div class="form-group @if ($errors->has('permanent_address')) has-error @endif">
    <label for="name" class="control-label">Permanent Address</label>
    <div class="box-body pad"> 
      <textarea name="permanent_address" id="permanent_address" class="textarea" placeholder="Permanent Address" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$employee->present_address}}</textarea> 
    </div> 
    @if ($errors->has('permanent_address')) <p class="help-block">{{ $errors->first('permanent_address') }}</p> @endif                          
  </div>
</div> 
<div class="col-md-6">
  <div class="form-group @if ($errors->has('health_details')) has-error @endif">
    <label for="name" class="control-label">Health Details</label>
    <div class="box-body pad"> 
      <textarea name="health_details" id="health_details" class="textarea" placeholder="Health Details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$employee->health_details}}</textarea> 
    </div> 
    @if ($errors->has('health_details')) <p class="help-block">{{ $errors->first('health_details') }}</p> @endif                          
  </div>
</div>    
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('emergency_contact_name')) has-error @endif">
    <label for="name" class="control-label">Emergency Contact Person</label> 
    <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" placeholder="Emergency Contact Name" value="{{$employee->emergency_contact_name}}" >                           
    @if ($errors->has('emergency_contact_name')) <p class="help-block">{{ $errors->first('emergency_contact_name') }}</p> @endif                             
  </div>
</div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('emergency_contact_relation')) has-error @endif">
    <label for="name" class="control-label">Relation</label> 
    <input type="text" class="form-control" id="emergency_contact_relation" name="emergency_contact_relation" placeholder="Emergency Contact Relation" value="{{$employee->emergency_contact_relation}}" >                           
    @if ($errors->has('emergency_contact_relation')) <p class="help-block">{{ $errors->first('emergency_contact_relation') }}</p> @endif                             
  </div>
</div>
<div class="col-md-6"> 
  <div class="form-group @if ($errors->has('emergency_contact_number')) has-error @endif">
    <label for="name" class="control-label">Emergency Contact Number</label> 
    <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" placeholder="Emergency Contact Number" value="{{$employee->emergency_contact_number}}" >                           
    @if ($errors->has('emergency_contact_number')) <p class="help-block">{{ $errors->first('emergency_contact_number') }}</p> @endif                             
  </div>
</div>

