<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login');
    });

    Route::group(['middleware' => 'adminauthcheck'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Branch Resources
        Route::resource('branch', 'BranchController');
        Route::get('branch/userdata', 'BranchController@show')->name('branch.userdata');

        // Fee Resources
        Route::resource('feeOffer', 'FeeOfferController');
        Route::get('feeOffer/userdata', 'FeeOfferController@show')->name('feeOffer.userdata');

        // Sub User Resources
        Route::resource('user', 'UserController');
        Route::get('user/userdata', 'UserController@show')->name('user.userdata');
        Route::post('/user/update-password', 'UserController@updatePassword')->name('user.udpate-password');
        Route::post('/user/change-password', 'UserController@changePassword')->name('user.change-password');

        // Student Resources
        Route::resource('student', 'StudentController');
        Route::get('student/userdata', 'StudentController@show')->name('student.userdata');

        // Finacial Year Resources
        Route::resource('academicYear', 'AcademicYearController');
        Route::get('academicYear/userdata', 'AcademicYearController@show')->name('academicYear.userdata');

        // Setting Resource
        Route::resource('setting', 'SettingController');

        // Student Fees
        Route::get('fees/{student_id}','StudentFeeController@getStudentFeeRecord')->name('getFeeHistory');
        Route::get('fees/add/{student_id}','StudentFeeController@create')->name('addFee');
        Route::post('fees/store','StudentFeeController@store')->name('feestore');

    });

    // logout user
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});



// Auth::routes();

Route::name('super_admin.')->namespace('SuperAdmin')->prefix('super-admin')->group(function () {
    Route::namespace('Auth')->middleware('guest:superAdmin')->group(function () {
        // Login
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login');
    });
    Route::group(['middleware' => 'superadminauthcheck'], function () {

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // User Resources
        Route::resource('user', 'UserController');
        Route::get('user/userdata', 'UserController@show')->name('user.userdata');
        Route::post('/user/change-password', 'UserController@changePassword')->name('user.change-password');

        // App Version Setting
        Route::resource('appversion', 'AppVersionController');
        Route::get('appversion/userdata', 'AppVersionController@show')->name('appversion.userdata');

        // logout user
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
