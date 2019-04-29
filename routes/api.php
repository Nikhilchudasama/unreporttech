<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('V1')->prefix('V1')->group(function(){
    Route::post('/singin', 'UserController@userAttemptLogin');
    Route::post('/forgetPassword', 'UserController@forgetPassword');
    Route::post('/updatePassword', 'UserController@updatePassword');
    Route::middleware('auth:api')->group(function(){
        // Branch List
        Route::get('/branchList', 'UserController@branchList');

        // User List
        Route::post('userList', 'UserController@userList');
        // Create User
        Route::post('/createUser', 'UserController@createUser');
        // Edit User
        Route::post('/editUser', 'UserController@editUser');
        // Update User
        Route::post('/updateUser', 'UserController@updateUser');

        // Branch Search List
        Route::post('searchBranchList', 'BranchController@searchBranchList');
        // Create Branch
        Route::post('/createBranch', 'BranchController@createBranch');
        // Create Branch
        Route::post('/editBranch', 'BranchController@editBranch');
        // Update User
        Route::post('/updateBranch', 'BranchController@updateBranch');

        // Academic Year List
        Route::post('ayList', 'AcademicYearController@academicYearList');
        // Create Academic Year
        Route::post('/createAY', 'AcademicYearController@createAY');
        // Edit Academic Year
        Route::post('/editAY', 'AcademicYearController@editAY');
        // Update Academic Year
        Route::post('/updateAY', 'AcademicYearController@updateAY');

        // Student List
        Route::post('/studentList', 'StudentController@studentList');
        // Create Student
        Route::post('/createStudent', 'StudentController@createStudent');
        // Edit Student
        Route::post('/editStudent', 'StudentController@editStudent');
        // Update Student
        Route::post('/updateStudent', 'StudentController@updateStudent');


        // Fee Offer List
        Route::post('/foList', 'FeeOfferController@foList');
        // Create Fee Offer
        Route::post('/createFO', 'FeeOfferController@createFO');
        // Edit Fee Offer
        Route::post('/editFO', 'FeeOfferController@editFO');
        // Update Fee Offer
        Route::post('/updateFO', 'FeeOfferController@updateFO');
    });
});
