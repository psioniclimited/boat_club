<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('bower_components/AdminLTE')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

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
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
      
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#">Link in level 2</a></li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      </li>




      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Organization</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu"> 
         <li><a href="{{URL::to('/district')}}">District</a></li>
         <li><a href="{{URL::to('/post_office')}}">Post Office</a></li>
         <li><a href="{{URL::to('/branch_type')}}">Branch Type</a></li>
         <li><a href="{{URL::to('/branch')}}">Branch</a></li>
         <li><a href="{{URL::to('/department_type')}}">Department Type</a></li>
         <li><a href="{{URL::to('/department')}}">Department</a></li>
         <li><a href="{{URL::to('/designation')}}">Designation</a></li>
         <li><a href="{{URL::to('/work_shift')}}">Work Shift</a></li>
         <li><a href="{{URL::to('/salary_head')}}">Salary Head</a></li>
         <li><a href="{{URL::to('/week_holiday')}}">Week Holiday</a></li>
         <li><a href="{{URL::to('/salary_grade')}}">Salary Grade</a></li>
      </ul>
    </li>


    <li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Setting</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{URL::to('/')}}/user/create">Create User</a></li>
        <li><a href="{{URL::to('/')}}/user/all_users">All Users</a></li> 
        <li><a href="{{URL::to('/')}}/role">Role</a></li> 
        <li><a href="{{URL::to('/')}}/permission">Permission</a></li> 
      </ul>
    </li>  

  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>