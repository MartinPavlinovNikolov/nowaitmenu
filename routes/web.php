<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
Route::get('/register', 'Auth\EmployerRegisterController@showRegistrationForm')->name('employer.register');
Route::post('/register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');
Route::get('/dashboard', 'EmployerController@index')->name('employer.dashboard');
Route::post('/logout', 'Auth\EmployerLoginController@employerLogout')->name('employer.logout');

Route::get('/employees', 'EmployerController@getEmployees')->name('employer.employees');

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/settings', 'AdminController@getSettings')->name('admin.settings');
    Route::post('/settings', 'AdminController@postSettings')->name('admin.settings.submit');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
    Route::get('/employers/search', 'AdminController@getSearchEmployers')->name('admin.employers.search');
    Route::get('/employers/active', 'AdminController@getActiveEmployers')->name('admin.employers.active');
    Route::get('/employers/disabled', 'AdminController@getDisabledEmployers')->name('admin.employers.disabled');
    Route::get('/employer/logout/{id}', 'AdminController@logoutEmployer')->name('admin.employer.logout');
    Route::get('/employer/delete/{id}', 'AdminController@deleteEmployer')->name('admin.employer.delete');
    Route::get('/employer/login/{id}', 'AdminController@loginEmployer')->name('admin.employer.login');
    Route::get('/employer/employee/logout/{employer_id}/{employee_id}', 'AdminController@loginEmployee')->name('admin.employer.employee.logout');
    Route::get('/employer/employee/login/{employer_id}/{employee_id}', 'AdminController@loginEmployee')->name('admin.employer.employee.login');
});
