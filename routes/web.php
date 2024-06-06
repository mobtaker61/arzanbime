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
$router->add('/admin/posts', 'PostController@index');
$router->add('/admin/posts/create', 'PostController@create');
$router->add('/admin/posts/store', 'PostController@store', 'POST');
$router->add('/admin/posts/edit/{id}', 'PostController@edit');
$router->add('/admin/posts/update/{id}', 'PostController@update', 'POST');
$router->add('/admin/posts/delete/{id}', 'PostController@delete');
