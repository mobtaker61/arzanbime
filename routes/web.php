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

// Protected routes
$router->add('/logout', 'AuthController@logout');
$router->add('/profile', 'UserController@showProfile');
$router->add('/profile', 'UserController@updateProfile', 'POST');
$router->add('/admin', 'AdminController@index');
