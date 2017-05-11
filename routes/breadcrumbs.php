<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', url('/'));
});

Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User', url('/all_user'));
});

Breadcrumbs::register('create_user', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Create User', url('/user/create'));
});
Breadcrumbs::register('permission', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Permission', url('/permission'));
});
Breadcrumbs::register('role', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Role', url('/role'));
});
Breadcrumbs::register('role_permission', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Role Permission', url('/role_permission'));
});
Breadcrumbs::register('branch', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Branch', url('/branch'));
});
Breadcrumbs::register('district', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('District', url('/district'));
});

Breadcrumbs::register('post_office', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Post Office', url('/post_office'));
});

Breadcrumbs::register('branch_type', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Branch Type', url('/branch_type'));
});

Breadcrumbs::register('department_type', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Department Type', url('/department_type'));
});
Breadcrumbs::register('department', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Department', url('/department'));
});
Breadcrumbs::register('designation', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Designation', url('/designation'));
});

Breadcrumbs::register('work_shift', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Work Shift', url('/work_shift'));
});

Breadcrumbs::register('salary_head', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Salary Head', url('/salary_head'));
});

Breadcrumbs::register('salary_grade', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Salary Grade', url('/salary_grade'));
});

Breadcrumbs::register('week_holiday', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Week Holiday', url('/week_holiday'));
});
Breadcrumbs::register('holiday', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Holiday', url('/holiday'));
});
