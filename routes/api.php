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
        // Update User
        Route::post('/updateUser', 'UserController@updateUser');

        
        // Create Branch
        Route::post('/createBranch', 'BranchController@createBranch');
        // Update User
        Route::post('/updateBranch', 'BranchController@updateBranch');
    });
});
