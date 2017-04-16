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