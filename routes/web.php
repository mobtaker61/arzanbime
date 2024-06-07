<?php
// Public routes
$router->add('/', 'HomeController@index');
$router->add('/login', 'AuthController@showLoginForm');
$router->add('/login', 'AuthController@login', 'POST');
$router->add('/register', 'AuthController@showRegisterForm');
$router->add('/register', 'AuthController@register', 'POST');
$router->add('/reset_password', 'AuthController@showResetPasswordForm');
$router->add('/reset_password', 'AuthController@resetPassword', 'POST');
$router->add('/set_new_password', 'AuthController@showNewPasswordForm');
$router->add('/set_new_password', 'AuthController@setNewPassword', 'POST');
$router->add('/post/{id}', 'PostController@show'); // Dynamic URL for posts

// Protected routes
$router->add('/logout', 'AuthController@logout');
$router->add('/profile', 'UserController@showProfile');
$router->add('/profile', 'UserController@updateProfile', 'POST');

// Admin routes
$router->add('/admin', 'AdminController@index');
// Post routes
$router->add('/admin/posts', 'PostController@index', 'GET');
$router->add('/admin/posts/create', 'PostController@create');
$router->add('/admin/posts/store', 'PostController@store', 'POST');
$router->add('/admin/posts/edit/{id}', 'PostController@edit');
$router->add('/admin/posts/update/{id}', 'PostController@update', 'POST');
$router->add('/admin/posts/delete/{id}', 'PostController@delete', 'GET'); // Use DELETE method
$router->add('/admin/posts/type/{type}', 'PostController@getByPostType', 'GET'); // New route for posts by type
// Company routes
$router->add('/admin/companies', 'CompanyController@index', 'GET');
$router->add('/admin/companies/store', 'CompanyController@store', 'POST');
$router->add('/admin/companies/create', 'CompanyController@create', 'GET');
$router->add('/admin/companies/edit/{id}', 'CompanyController@edit', 'GET');
$router->add('/admin/companies/update/{id}', 'CompanyController@update', 'POST');
$router->add('/admin/companies/delete/{id}', 'CompanyController@delete', 'GET'); // Use DELETE method
// Package routes
$router->add('/admin/packages', 'PackageController@index', 'GET');
$router->add('/admin/packages/create', 'PackageController@create', 'GET');
$router->add('/admin/packages/store', 'PackageController@store', 'POST');
$router->add('/admin/packages/edit/{id}', 'PackageController@edit', 'GET');
$router->add('/admin/packages/update/{id}', 'PackageController@update', 'POST');
$router->add('/admin/packages/delete/{id}', 'PackageController@delete', 'GET');
$router->add('/admin/packages/company/{company_id}', 'PackageController@viewByCompany', 'GET'); // New route
// Tariff routes
$router->add('/admin/tariffs', 'TariffController@index', 'GET');
$router->add('/admin/tariffs/store', 'TariffController@store', 'POST');
$router->add('/admin/tariffs/edit/{id}', 'TariffController@edit', 'GET');
$router->add('/admin/tariffs/update/{id}', 'TariffController@update', 'POST');
$router->add('/admin/tariffs/delete/{id}', 'TariffController@delete', 'GET');
