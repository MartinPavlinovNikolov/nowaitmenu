<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
Route::get('/register', 'Auth\EmployerRegisterController@showRegisterForm')->name('employer.register');
Route::post('/register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');
Route::get('/dashboard', 'EmployerController@index')->name('employer.dashboard');
Route::post('/logout', 'Auth\EmployerLoginController@employerLogout')->name('employer.logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
});
