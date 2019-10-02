<?php

use\App\Employee;
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

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
*/

Route::get('/dashboard','DashboardController@index')->name('dashboard');



Route::resource('departments', 'DepartmentsController');
Route::post('/departments/search','DepartmentsController@search')->name('departments.search');


Route::get('/employees/{id}/otpusti','EmployeesController@otpusti')->name('employees.otpusti');
Route::put('/employees/{id}/prebaciUEx','EmployeesController@prebaciUEx')->name('employees.prebaciUEx');
Route::resource('employees', 'EmployeesController');
Route::post('employees/search','EmployeesController@search')->name('employees.search');

Route::resource('candidates', 'CandidatesController');
Route::post('candidates/search','CandidatesController@search')->name('candidates.search');

Route::resource('ex_employees', 'Ex_employeesController');
Route::post('ex_employees/search','Ex_employeesController@search')->name('ex_employees.search');

Route::resource('attendances', 'AttendancesController');
Route::post('attendances/search','AttendancesController@search')->name('attendances.search');

Route::resource('leaves', 'LeavesController');
Route::post('leaves/search','LeavesController@search')->name('leaves.search');

Route::resource('leave_types', 'Leave_typesController');
Route::post('/leave_types/search','Leave_typesController@search')->name('leave_types.search');

Route::resource('users', 'UsersController');

Route::resource('/admins','AdminsController');
Route::post('/admins','AdminsController@search')->name('admins.search');
Route::post('/admins/create','AdminsController@store')->name('admins.store');




/**
 *  Auth Route(s)
 */

//show the login view
Route::get('/','AuthController@index')->name('login')->middleware('guest');

//Authenticate a user
Route::post('/','AuthController@authenticate')->name('auth.authenticate');

//logout the user
Route::get('/logout','AuthController@logout')->name('auth.logout')->middleware('auth');

//show user details
Route::get('/admin','AuthController@show')->name('auth.show')->middleware('auth');

Route::get('/password/reset','ResetPassword\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email','ResetPassword\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}','ResetPassword\ResetPasswordController@showResetForm')->name('password.reset');

//Show Reports View
Route::get('/reports','ReportsController@index')->name('reports.index');

/**
Route::get('/reports/get_datatable','ReportsController@get_datatable');
Route::get('getEmployeesWithDepartmentID','ReportsController@getEmployees');
 */

//Generate PDF
Route::post('/reports/pdf','ReportsController@makeReport')->name('reports.make');

Route::post('/password/reset','ResetPassword\ResetPasswordController@reset');


