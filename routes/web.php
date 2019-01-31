<?php

//marketing static page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Employer Home page
Route::get('home', 'EmployerController@home')->name('employer.home');
//Employer->employees CRUD
//Route::resource('employees', 'EmployerEmployeesController');
//Employer login, logout, register;
Route::get('login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login.form');
Route::post('login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
Route::put('logout', 'Auth\EmployerLoginController@logout')->name('employer.logout');
Route::get('register', 'Auth\EmployerRegisterController@showRegistrationForm')->name('employer.register.form');
Route::post('register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');

Route::prefix('admin')->group(function() {

    //List employers, delete employers;
    Route::resource('employers', 'AdminEmployersController')->only([
        'index', 'destroy'
    ])->names([
        'index'   => 'admin.employers.index', 'destroy' => 'admin.employers.destroy'
    ]);

    Route::prefix('employers')->group(function() {

        //Find all employers, who are allowed to use this application
        Route::resource('active', 'AdminActiveEmployersController')->only([
            'index'
        ])->names([
            'index' => 'admin.employers.active'
        ]);

        //Find all employers, who are not allowed to use this application
        Route::resource('by/name', 'AdminEmployersByNameController')->only([
            'show'
        ])->names([
            'show' => 'admin.employers.by.name.show'
        ]);

        //Find all employers, where names containigs the given string
        Route::resource('by/email', 'AdminEmployersByEmailController')->only([
            'show'
        ])->names([
            'show' => 'admin.employers.by.email.show'
        ]);

        //Find all employers, where emails containigs the given string
        Route::resource('disabled', 'AdminDisabledEmployersController')->only([
            'index'
        ])->names([
            'index' => 'admin.employers.disabled'
        ]);

        //Toggle access of the employer to access this application
        Route::resource('status', 'AdminEmployersStatusesController')->only([
            'update'
        ])->names([
            'update' => 'admin.employers.status.update'
        ]);
    });

    Route::resource('employees', 'AdminEmployeesController');

    //Get login form for administrator
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');

    //Submit data for authenticate the administrator
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    //Login out the administrator
    Route::put('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //Menage setting for password of the administrator
    Route::resource('settings', 'AdminSettingsController')->only([
        'update',
        'edit'
    ])->names([
        'edit'   => 'admin.settings.edit',
        'update' => 'admin.settings.update'
    ]);
});
