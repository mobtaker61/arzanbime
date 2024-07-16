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
$router->add('/auth/send-otp', 'App\Controllers\AuthController@sendOTP', 'POST');
$router->add('/auth/verify-otp', 'App\Controllers\AuthController@verifyOTP', 'POST');
$router->add('/auth/store-quotation-data', 'App\Controllers\AuthController@storeQuotationData', 'POST');
$router->add('/auth/check-tel', 'App\Controllers\AuthController@checkTel', 'POST');
$router->add('/logout', 'App\Controllers\AuthController@logout');
$router->add('/getTariffSummary/{companyId:\d+}', 'App\Controllers\HomeController@getTariffSummary');
$router->add('/save-token', 'App\Controllers\NotificationController@saveToken', 'POST');
$router->add('/send-notification/{userId}/{title}/{body}', 'App\Controllers\NotificationController@sendNotificationToUser');
// Contact page route
$router->add('/contact', 'App\Controllers\ContactController@index');
$router->add('/contact/submit', 'App\Controllers\ContactController@submit', 'POST');
// Public User routes
$router->add('/offices/byProvince/{provinceId}', 'App\Controllers\OfficeController@getOfficesByProvince', 'GET');
$router->add('/companies', 'App\Controllers\CompanyController@index', 'GET');
$router->add('/companies/details/{companyId}', 'App\Controllers\CompanyController@getCompanyDetails', 'GET');
// Offers route (requires public layout)
$router->add('/offers/{uid}', 'App\Controllers\OffersController@show', 'GET');
// Post
$router->add('/posts', 'App\Controllers\PostController@index', 'GET');
$router->add('/posts/{postType}', 'App\Controllers\PostController@index', 'GET');
$router->add('/post/{id}', 'App\Controllers\PostController@show', 'GET');

// User routes (requires authentication)
$router->add('/user', 'App\Controllers\UserController@dashboard');
$router->add('/user/profile', 'App\Controllers\ProfileController@show');
$router->add('/user/profile/create', 'App\Controllers\ProfileController@create');
$router->add('/user/profile/store', 'App\Controllers\ProfileController@store', 'POST');
$router->add('/user/profile/edit/{id}', 'App\Controllers\ProfileController@edit');
$router->add('/user/profile/update', 'App\Controllers\ProfileController@update', 'POST');
$router->add('/user/profile/uploadImage', 'App\Controllers\ProfileController@uploadImage', 'POST');
// Admin routes (requires admin authentication)
$router->add('/admin', 'App\Controllers\Admin\AdminController@dashboard', 'GET');

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
$router->add('/admin/tariffs/getTariff', 'App\Controllers\Admin\TariffController@getTariff');

// Admin quotation routes
$router->add('/admin/quotations', 'App\Controllers\Admin\QuotationController@index', 'GET');
$router->add('/admin/quotations/detail/{id}', 'App\Controllers\Admin\QuotationController@detail', 'GET');
$router->add('/admin/quotations/store', 'App\Controllers\Admin\QuotationController@store', 'POST');
$router->add('/admin/quotations/addFollowup', 'App\Controllers\Admin\QuotationController@addFollowup', 'POST');
$router->add('/admin/quotations/manual', 'App\Controllers\Admin\QuotationController@manualQuotationForm', 'GET');
$router->add('/admin/quotations/getOffers/{id}', 'App\Controllers\Admin\QuotationController@getOffers', 'GET');
$router->add('/admin/quotations/check-or-create-user', 'App\Controllers\Admin\QuotationController@checkOrCreateUser', 'POST');
$router->add('/admin/quotations/createFromOrder', 'App\Controllers\Admin\QuotationController@createFromOrder', 'POST');

// Admin user levels routes
$router->add('/admin/user-levels', 'App\Controllers\Admin\UserLevelController@index', 'GET');
$router->add('/admin/user-levels/create', 'App\Controllers\Admin\UserLevelController@create', 'GET');
$router->add('/admin/user-levels/store', 'App\Controllers\Admin\UserLevelController@store', 'POST');
$router->add('/admin/user-levels/edit/{id}', 'App\Controllers\Admin\UserLevelController@edit', 'GET');
$router->add('/admin/user-levels/update/{id}', 'App\Controllers\Admin\UserLevelController@update', 'POST');
$router->add('/admin/user-levels/delete/{id}', 'App\Controllers\Admin\UserLevelController@delete', 'GET');

// Admin package discounts routes
$router->add('/admin/package-discounts', 'App\Controllers\Admin\PackageDiscountController@index', 'GET');
$router->add('/admin/package-discounts/create', 'App\Controllers\Admin\PackageDiscountController@create', 'GET');
$router->add('/admin/package-discounts/store', 'App\Controllers\Admin\PackageDiscountController@store', 'POST');
$router->add('/admin/package-discounts/edit/{id}', 'App\Controllers\Admin\PackageDiscountController@edit', 'GET');
$router->add('/admin/package-discounts/update/{id}', 'App\Controllers\Admin\PackageDiscountController@update', 'POST');
$router->add('/admin/package-discounts/delete/{id}', 'App\Controllers\Admin\PackageDiscountController@delete', 'GET');

// Admin agent routes
$router->add('/admin/agents', 'App\Controllers\Admin\AgentController@index', 'GET');
$router->add('/admin/agents/store', 'App\Controllers\Admin\AgentController@store', 'POST');
$router->add('/admin/agents/edit/{id}', 'App\Controllers\Admin\AgentController@edit', 'GET');
$router->add('/admin/agents/update/{id}', 'App\Controllers\Admin\AgentController@update', 'POST');
$router->add('/admin/agents/delete/{id}', 'App\Controllers\Admin\AgentController@delete', 'DELETE');

// Admin user routes
$router->add('/admin/users', 'App\Controllers\Admin\UserController@index', 'GET');
$router->add('/admin/users/store', 'App\Controllers\Admin\UserController@store', 'POST');
$router->add('/admin/users/edit/{id}', 'App\Controllers\Admin\UserController@edit', 'GET');
$router->add('/admin/users/update/{id}', 'App\Controllers\Admin\UserController@update', 'POST');
$router->add('/admin/users/delete/{id}', 'App\Controllers\Admin\UserController@delete', 'DELETE');
$router->add('/admin/profiles/{id}', 'App\Controllers\Admin\QuotationController@getProfile', 'GET');
$router->add('/admin/profiles/update', 'App\Controllers\Admin\QuotationController@updateProfile', 'POST');

// Admin broker routes
$router->add('/admin/brokers', 'App\Controllers\Admin\BrokerController@index', 'GET');
$router->add('/admin/brokers/store', 'App\Controllers\Admin\BrokerController@store', 'POST');
$router->add('/admin/brokers/edit/{id}', 'App\Controllers\Admin\BrokerController@edit', 'GET');
$router->add('/admin/brokers/update/{id}', 'App\Controllers\Admin\BrokerController@update', 'POST');
$router->add('/admin/brokers/delete/{id}', 'App\Controllers\Admin\BrokerController@delete', 'DELETE');

// Admin broker package commission routes
$router->add('/admin/commissions', 'App\Controllers\Admin\BrokerPackageCommissionController@index', 'GET');
$router->add('/admin/commissions/store', 'App\Controllers\Admin\BrokerPackageCommissionController@store', 'POST');
$router->add('/admin/commissions/edit/{id}', 'App\Controllers\Admin\BrokerPackageCommissionController@edit', 'GET');
$router->add('/admin/commissions/update/{id}', 'App\Controllers\Admin\BrokerPackageCommissionController@update', 'POST');
$router->add('/admin/commissions/delete/{id}', 'App\Controllers\Admin\BrokerPackageCommissionController@delete', 'DELETE');

// Admin Order routes
$router->add('/admin/orders', 'App\Controllers\Admin\OrderController@index');
$router->add('/admin/orders/export', 'App\Controllers\Admin\OrderController@exportToExcel');
$router->add('/admin/orders/store', 'App\Controllers\Admin\OrderController@store', 'POST');
$router->add('/admin/orders/getPackagesByBroker/{id}', 'App\Controllers\Admin\OrderController@getPackagesByBroker');
$router->add('/admin/tariffs/getHighestCommission/{id:\d+}', 'App\Controllers\Admin\TariffController@getHighestCommission');
$router->add('/admin/orders/sendReminder', 'App\Controllers\Admin\OrderController@sendReminder', 'POST');

// Admin Transaction
$router->add('/admin/transactions', 'App\Controllers\Admin\TransactionController@index');
$router->add('/admin/transactions/create', 'App\Controllers\Admin\TransactionController@create');
$router->add('/admin/transactions/store', 'App\Controllers\Admin\TransactionController@store','POST');
$router->add('/admin/transactions/edit/{id}', 'App\Controllers\Admin\TransactionController@edit');
$router->add('/admin/transactions/update/{id}', 'App\Controllers\Admin\TransactionController@update','DELETE');

$router->add('/admin/broker_transactions', 'App\Controllers\Admin\BrokerTransactionController@index');
$router->add('/admin/broker_transactions/store', 'App\Controllers\Admin\BrokerTransactionController@store','POST');
$router->add('/admin/broker_transactions/edit/{id:\d+}', 'App\Controllers\Admin\BrokerTransactionController@edit');
$router->add('/admin/broker_transactions/update/{id:\d+}', 'App\Controllers\Admin\BrokerTransactionController@update','POST');

$router->add('/admin/transaction-types', 'App\Controllers\Admin\TransactionTypeController@index');
$router->add('/admin/transaction-types/store', 'App\Controllers\Admin\TransactionTypeController@store', 'POST');
$router->add('/admin/transaction-types/update/{id:\d+}', 'App\Controllers\Admin\TransactionTypeController@update', 'POST');
$router->add('/admin/transaction-types/delete/{id:\d+}', 'App\Controllers\Admin\TransactionTypeController@delete', 'DELETE');


//************** AGENT **********************/
// Agent routes (requires agent authentication)
$router->add('/agent', 'App\Controllers\Agent\AgentController@dashboard', 'GET');

//************** EXTRA **********************/
// Sitemap & RSS feed routes
$router->add('/sitemap.xml', 'App\Controllers\RssController@sitemap');
$router->add('/rss', 'App\Controllers\RssController@index', 'GET');
$router->add('/rss/{postType}', 'App\Controllers\RssController@byPostType', 'GET');
$router->add('/admin/getChartData', 'App\Controllers\Admin\AdminController@getChartData');
$router->add('/admin/getUsers', 'App\Controllers\Admin\AdminController@getUsers');
$router->add('/admin/getBrokers', 'App\Controllers\Admin\AdminController@getBrokers');
$router->add('/admin/fast/transactions', 'App\Controllers\Admin\AdminController@storeUserTransaction','POST');
$router->add('/admin/fast/broker-transactions', 'App\Controllers\Admin\AdminController@storeBrokerTransaction','POST');
$router->add('/admin/sendSms', 'App\Controllers\Admin\AdminController@sendSMS', 'POST');
