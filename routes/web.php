<?php

use Core\Router;

$router = new Router();

// Public routes
$router->add('/', 'App\Controllers\HomeController@index');
$router->add('/login', 'App\Controllers\AuthController@showLoginForm');
$router->add('/login', 'App\Controllers\AuthController@login', 'POST');
$router->add('/register', 'App\Controllers\AuthController@showRegisterForm');
$router->add('/register', 'App\Controllers\AuthController@register', 'POST');
$router->add('/reset_password', 'App\Controllers\AuthController@showResetPasswordForm');
$router->add('/reset_password', 'App\Controllers\AuthController@resetPassword', 'POST');
$router->add('/set_new_password', 'App\Controllers\AuthController@showNewPasswordForm');
$router->add('/set_new_password', 'App\Controllers\AuthController@setNewPassword', 'POST');
$router->add('/post/{id}', 'App\Controllers\PostController@show', 'GET');

// Sitemap route
$router->add('/sitemap.xml', function() {
    header('Content-Type: application/xml');
    readfile('app/public/sitemap.xml');
    exit();
});

// Public User routes
$router->add('/offices/byProvince/{provinceId}', 'App\Controllers\OfficeController@getOfficesByProvince', 'GET');
$router->add('/companies', 'App\Controllers\CompanyController@index', 'GET');
$router->add('/companies/details/{companyId}', 'App\Controllers\CompanyController@getCompanyDetails', 'GET');

// Post
$router->add('/posts', 'App\Controllers\PostController@index', 'GET');
$router->add('/posts/{postType}', 'App\Controllers\PostController@index', 'GET');
$router->add('/post/{id}', 'App\Controllers\PostController@show', 'GET');

// User routes (requires authentication)
$router->add('/user/dashboard', 'App\Controllers\UserController@dashboard', 'GET', 'Middleware::auth');

// Protected routes
$router->add('/logout', 'App\Controllers\AuthController@logout');
$router->add('/profile', 'App\Controllers\UserController@showProfile');
$router->add('/profile', 'App\Controllers\UserController@updateProfile', 'POST');

// Admin routes (requires admin authentication)
$router->add('/admin', 'App\Controllers\Admin\AdminController@dashboard', 'GET', 'Middleware::admin');

// Admin post routes
$router->add('/admin/posts', 'App\Controllers\Admin\PostController@index', 'GET');
$router->add('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->add('/admin/posts/store', 'App\Controllers\Admin\PostController@store', 'POST');
$router->add('/admin/posts/edit/{id}', 'App\Controllers\Admin\PostController@edit');
$router->add('/admin/posts/update/{id}', 'App\Controllers\Admin\PostController@update', 'POST');
$router->add('/admin/posts/delete/{id}', 'App\Controllers\Admin\PostController@delete', 'GET');
$router->add('/admin/posts/type/{type}', 'App\Controllers\Admin\PostController@getByPostType', 'GET');

// Admin company routes
$router->add('/admin/companies', 'App\Controllers\Admin\CompanyController@index', 'GET');
$router->add('/admin/companies/store', 'App\Controllers\Admin\CompanyController@store', 'POST');
$router->add('/admin/companies/create', 'App\Controllers\Admin\CompanyController@create', 'GET');
$router->add('/admin/companies/edit/{id}', 'App\Controllers\Admin\CompanyController@edit', 'GET');
$router->add('/admin/companies/update/{id}', 'App\Controllers\Admin\CompanyController@update', 'POST');
$router->add('/admin/companies/delete/{id}', 'App\Controllers\Admin\CompanyController@delete', 'GET');

// Admin package routes
$router->add('/admin/packages', 'App\Controllers\Admin\PackageController@index', 'GET');
$router->add('/admin/packages/create', 'App\Controllers\Admin\PackageController@create', 'GET');
$router->add('/admin/packages/store', 'App\Controllers\Admin\PackageController@store', 'POST');
$router->add('/admin/packages/edit/{id}', 'App\Controllers\Admin\PackageController@edit', 'GET');
$router->add('/admin/packages/update/{id}', 'App\Controllers\Admin\PackageController@update', 'POST');
$router->add('/admin/packages/delete/{id}', 'App\Controllers\Admin\PackageController@delete', 'DELETE');
$router->add('/admin/packages/company/{company_id}', 'App\Controllers\Admin\PackageController@viewByCompany', 'GET');
$router->add('/admin/packages/addAges/{id}', 'App\Controllers\Admin\PackageController@addAges', 'POST');
$router->add('/admin/packages/tariffs/{packageId}', 'App\Controllers\Admin\PackageController@tariffs', 'GET');

// Admin tariff routes
$router->add('/admin/tariffs', 'App\Controllers\Admin\TariffController@index', 'GET');
$router->add('/admin/tariffs/store', 'App\Controllers\Admin\TariffController@store', 'POST');
$router->add('/admin/tariffs/edit/{id}', 'App\Controllers\Admin\TariffController@edit', 'GET');
$router->add('/admin/tariffs/update/{id}', 'App\Controllers\Admin\TariffController@update', 'POST');
$router->add('/admin/tariffs/delete/{id}', 'App\Controllers\Admin\TariffController@delete', 'DELETE');
$router->add('/admin/tariffs/updateField/{id}', 'App\Controllers\Admin\TariffController@updateField', 'POST');
$router->add('/admin/tariffs/setTariff', 'App\Controllers\Admin\TariffController@setTariff', 'POST');

// Admin quotation routes
$router->add('/admin/quotations', 'App\Controllers\Admin\QuotationController@index', 'GET');
$router->add('/admin/quotations/detail/{id}', 'App\Controllers\Admin\QuotationController@detail', 'GET');
$router->add('/admin/quotations/store', 'App\Controllers\Admin\QuotationController@store', 'POST');
$router->add('/admin/quotations/addFollowup', 'App\Controllers\Admin\QuotationController@addFollowup', 'POST');
$router->add('/admin/quotations/offers/{id}', 'App\Controllers\Admin\QuotationController@showOffers', 'GET');
