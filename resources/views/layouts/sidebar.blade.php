<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('bower_components/AdminLTE')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div> -->

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

<!-- Sidebar Menu -->
<ul class="sidebar-menu">
    
    <!-- Starts Organization -->
    <li {!! Request::is('district') || Request::is('post_office') || Request::is('branch_type') || Request::is('branch') || Request::is('department_type') || Request::is('department') || Request::is('designation') || Request::is('work_shift') || Request::is('salary_head') || Request::is('salary_grade') || Request::is('salary_grade/create') || Request::is('loan_type') || Request::is('loan_type/create') || Request::is('week_holiday') || Request::is('holiday') || Request::is('leave_type') || Request::is('leave_package') || Request::is('leave_package/create') || Request::is('attendance_deduction') || Request::is('attendance_deduction/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Organization</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li {!! Request::is('district') ? ' class="active"' : null !!}><a href="{{URL::to('/district')}}"><i class="fa fa-circle-o"></i> District</a></li>
            <li {!! Request::is('post_office') ? ' class="active"' : null !!}><a href="{{URL::to('/post_office')}}"><i class="fa fa-circle-o"></i> Post Office</a></li>
            <li {!! Request::is('branch_type') ? ' class="active"' : null !!}><a href="{{URL::to('/branch_type')}}"><i class="fa fa-circle-o"></i>Branch Type</a></li>
            <li {!! Request::is('branch') ? ' class="active"' : null !!}><a href="{{URL::to('/branch')}}"><i class="fa fa-circle-o"></i>Branch</a></li>
            <li {!! Request::is('department_type') ? ' class="active"' : null !!}><a href="{{URL::to('/department_type')}}"><i class="fa fa-circle-o"></i>Department Type</a></li>
            <li {!! Request::is('department') ? ' class="active"' : null !!}><a href="{{URL::to('/department')}}"><i class="fa fa-circle-o"></i>Department</a></li>
            <li {!! Request::is('designation') ? ' class="active"' : null !!}><a href="{{URL::to('/designation')}}"><i class="fa fa-circle-o"></i>Designation</a></li>
            <li {!! Request::is('work_shift') ? ' class="active"' : null !!}><a href="{{URL::to('/work_shift')}}"><i class="fa fa-circle-o"></i>Work Shift</a></li>
            <li {!! Request::is('salary_head') ? ' class="active"' : null !!}><a href="{{URL::to('/salary_head')}}"><i class="fa fa-circle-o"></i>Salary Head</a></li>
            <li {!! Request::is('salary_grade') || Request::is('salary_grade/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Salary Grade
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('salary_grade') ? ' class="active"' : null !!}><a href="{{URL::to('/salary_grade')}}"><i class="fa fa-circle-o"></i>Salary Grade List</a></li>
                    <li {!! Request::is('salary_grade/create') ? ' class="active"' : null !!}><a href="{{URL::to('/salary_grade/create')}}"><i class="fa fa-circle-o"></i>Create Salary Grade</a></li>
                </ul>
            </li>
            <li {!! Request::is('loan_type') || Request::is('loan_type/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Loan Type
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('loan_type') ? ' class="active"' : null !!}><a href="{{URL::to('/loan_type')}}"><i class="fa fa-circle-o"></i>Loan Type List</a></li>
                    <li {!! Request::is('loan_type/create') ? ' class="active"' : null !!}><a href="{{URL::to('/loan_type/create')}}"><i class="fa fa-circle-o"></i>Create New Loan Type</a></li>
                </ul>
            </li>
            <li {!! Request::is('week_holiday') ? ' class="active"' : null !!}><a href="{{URL::to('/week_holiday')}}"><i class="fa fa-circle-o"></i>Week Holiday</a></li>
            <li {!! Request::is('holiday') ? ' class="active"' : null !!}><a href="{{URL::to('/holiday')}}"><i class="fa fa-circle-o"></i>Holiday</a></li>
            <li {!! Request::is('leave_type') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_type')}}"><i class="fa fa-circle-o"></i>Leave Type</a></li>
            <li {!! Request::is('leave_package') || Request::is('leave_package/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Loan Type
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('leave_package') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_package')}}"><i class="fa fa-circle-o"></i>Leave Package List</a></li>
                    <li {!! Request::is('leave_package/create') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_package/create')}}"><i class="fa fa-circle-o"></i>Create New Package</a></li>
                </ul>
            </li>
            <li {!! Request::is('attendance_deduction') || Request::is('attendance_deduction/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Attendance Deduction Setup
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('attendance_deduction') ? ' class="active"' : null !!}><a href="{{URL::to('/attendance_deduction')}}"><i class="fa fa-circle-o"></i>Attendance Deduction Policy List</a></li>
                    <li {!! Request::is('attendance_deduction/create') ? ' class="active"' : null !!}><a href="{{URL::to('/attendance_deduction/create')}}"><i class="fa fa-circle-o"></i>Create New Policy</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- Ends KOrganization -->

    
    <!-- Starts Job Management -->
    <li {!! Request::is('job_opening') || Request::is('job_opening/create') || Request::is('job_applicant') || Request::is('job_applicant/create') || Request::is('offer_letter') || Request::is('offer_letter/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Job Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li {!! Request::is('job_opening') || Request::is('job_opening/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Job Opening
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('job_opening') ? ' class="active"' : null !!}><a href="{{URL::to('/job_opening')}}"><i class="fa fa-circle-o"></i>Job Opening List</a></li>
                    <li {!! Request::is('job_opening/create') ? ' class="active"' : null !!}><a href="{{URL::to('/job_opening/create')}}"><i class="fa fa-circle-o"></i>Create new Job Opening</a></li>
                </ul>
            </li>
            <li {!! Request::is('job_applicant') || Request::is('job_applicant/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Job Applicant
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('job_applicant') ? ' class="active"' : null !!}><a href="{{URL::to('/job_applicant')}}"><i class="fa fa-circle-o"></i>Job Applicant List</a></li>
                    <li {!! Request::is('job_applicant/create') ? ' class="active"' : null !!}><a href="{{URL::to('/job_applicant/create')}}"><i class="fa fa-circle-o"></i>Create new Job Applicant</a></li>
                </ul>
            </li>
            <li {!! Request::is('offer_letter') || Request::is('offer_letter/create') ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
                <a href="#"> <i class="fa fa-circle-o"></i>Offer Letter
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li {!! Request::is('offer_letter') ? ' class="active"' : null !!}><a href="{{URL::to('/offer_letter')}}"><i class="fa fa-circle-o"></i>Offer Letter List</a></li>
                    <li {!! Request::is('offer_letter/create') ? ' class="active"' : null !!}><a href="{{URL::to('/offer_letter/create')}}"><i class="fa fa-circle-o"></i>Create new Offer Letter</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- Ends Job Management -->

    <!-- Starts Employee Management -->
    <li {!! Request::is('employee') || Request::is('create_employee') || Request::is('employee_transfer_and_promotion') || Request::is('employee_resignation') || Request::is('employee_resignation') || Request::is('employee_reinitialize')  ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Employee Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li {!! Request::is('employee') ? ' class="active"' : null !!}><a href="{{URL::to('/employee')}}"><i class="fa fa-circle-o"></i> Employee List</a></li>
            <li {!! Request::is('create_employee') ? ' class="active"' : null !!}><a href="{{URL::to('/create_employee')}}"><i class="fa fa-circle-o"></i> Create Employee</a></li>
            <li {!! Request::is('employee_transfer_and_promotion') ? ' class="active"' : null !!}><a href="{{URL::to('/employee_transfer_and_promotion')}}"><i class="fa fa-circle-o"></i> Employee Transfer & Promotion</a></li>
            <li {!! Request::is('employee_resignation') ? ' class="active"' : null !!}><a href="{{URL::to('/employee_resignation')}}"><i class="fa fa-circle-o"></i> Employee Resignation</a></li>
            <li {!! Request::is('employee_reinitialize') ? ' class="active"' : null !!}><a href="{{URL::to('/employee_reinitialize')}}"><i class="fa fa-circle-o"></i> Employee Re Initialize</a></li>
        </ul>
    </li>
    <!-- Ends Employee Management -->

    <!-- Starts Attendance -->
    <li {!! Request::is('attendance') || Request::is('bulk_attendance') || Request::is('attendance_list')  ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Attendance</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li {!! Request::is('attendance') ? ' class="active"' : null !!}><a href="{{URL::to('/attendance')}}"><i class="fa fa-circle-o"></i> Individual Attendance</a></li>
            <li {!! Request::is('bulk_attendance') ? ' class="active"' : null !!}><a href="{{URL::to('/bulk_attendance')}}"><i class="fa fa-circle-o"></i> Bulk Attendance</a></li>
            <li {!! Request::is('attendance_list') ? ' class="active"' : null !!}><a href="{{URL::to('/attendance_list')}}"><i class="fa fa-circle-o"></i> Attendance List</a></li>
        </ul>
    </li>
    <!-- Ends Attendance -->

    <!-- Starts Employee Leave -->
    <li {!! Request::is('leave_application') || Request::is('leave_application/create') || Request::is('leave_approval') || Request::is('leave_stock')  ? ' class="active treeview"' : ' class="treeview"' !!} class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Employee Leave</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li {!! Request::is('leave_application') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_application')}}"><i class="fa fa-circle-o"></i> Leave Application List</a></li>
            <li {!! Request::is('leave_application/create') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_application/create')}}"><i class="fa fa-circle-o"></i> Create Leave Application</a></li>
            <li {!! Request::is('leave_approval') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_approval')}}"><i class="fa fa-circle-o"></i> Leave Approval</a></li>
            <li {!! Request::is('leave_stock') ? ' class="active"' : null !!}><a href="{{URL::to('/leave_stock')}}"><i class="fa fa-circle-o"></i> Leave Record</a></li>
        </ul>
    </li>
    <!-- Ends Employee Leave -->



</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>