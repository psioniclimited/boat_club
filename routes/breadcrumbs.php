<?php
// Home
Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->push('User', url('/user'));
});

Breadcrumbs::register('create_user', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Create User', url('/user/create'));
});