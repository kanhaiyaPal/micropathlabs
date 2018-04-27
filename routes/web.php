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

Route::view('/', 'welcome', ['Appname' => 'Micro Path Labs']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/nopermission', 'HomeController@nopermission');

Route::get('/globalsettings', 'Globals\SettingsController@index')->middleware("checkrole:view,global_settings");
Route::post('/saveglobalsettings', 'Globals\SettingsController@save')->middleware("checkrole:modify,global_settings");
/*--Admin mail and password change--*/
Route::post('/changeadmincredentials','HomeController@changeadmincredentials');

/*--Patient Routes--*/
Route::get('/patients', 'Patients\PatientOperationController@index')->middleware("checkrole:view,patient");
Route::get('/patient/register', 'Patients\PatientOperationController@showpatientregisterform')->middleware("checkrole:write,patient");
Route::post('/patient/register', 'Patients\PatientOperationController@createnewpatient')->middleware("checkrole:write,patient");
Route::get('/patient/{patient}', 'Patients\PatientOperationController@showpatienteditform')->middleware("checkrole:read,patient");
Route::match(['put','patch','options'],'/patient/{patient}','Patients\PatientOperationController@saveexistingpatient')->middleware("checkrole:modify,patient");
Route::delete('/patient/{patient}', 'Patients\PatientOperationController@showpatienteditform')->middleware("checkrole:delete,patient");

/*--Centers--*/
Route::get('/centeres', 'Centers\CenterOperationController@index')->middleware("checkrole:view,center");
Route::get('/centeres/create', 'Centers\CenterOperationController@shownewcenterform')->middleware("checkrole:write,center");
Route::post('/centeres/create', 'Centers\CenterOperationController@addnewcenter')->middleware("checkrole:write,center");
Route::get('/centeres/{center}/edit', 'Centers\CenterOperationController@showcentereditform')->middleware("checkrole:read,center");
Route::match(['put','patch','options'],'/centeres/{center}','Centers\CenterOperationController@saveexistingcenter')->middleware("checkrole:modify,center");
Route::delete('/centeres/{center}', 'Centers\CenterOperationController@deletecenter')->middleware("checkrole:delete,center");
Route::post('/centeres/deleteall', 'Centers\CenterOperationController@deleteall')->middleware("checkrole:delete,center");

/*--Departments--*/
Route::get('/departments', 'Departments\DepartmentOperationController@index')->middleware("checkrole:view,departments");
Route::get('/departments/create', 'Departments\DepartmentOperationController@shownewdepartmentform')->middleware("checkrole:write,departments");
Route::post('/departments/create', 'Departments\DepartmentOperationController@addnewdepartment')->middleware("checkrole:write,departments");
Route::get('/departments/{department}/edit', 'Departments\DepartmentOperationController@showdepartmenteditform')->middleware("checkrole:read,departments");
Route::match(['put','patch','options'],'/departments/{department}','Departments\DepartmentOperationController@save_changes')->middleware("checkrole:modify,departments");
Route::delete('/departments/{department}', 'Departments\DepartmentOperationController@delete')->middleware("checkrole:delete,departments");
Route::post('/departments/deleteall', 'Departments\DepartmentOperationController@deleteall')->middleware("checkrole:delete,departments");

/*--Signatures--*/
Route::get('/signatures/create', 'Signatures\SignatureOperationController@shownewsignatureform')->middleware("checkrole:write,signatures");
Route::post('/signatures/create', 'Signatures\SignatureOperationController@addnewsignature')->middleware("checkrole:write,signatures");
Route::get('/signatures/{signature}/edit', 'Signatures\SignatureOperationController@editform')->middleware("checkrole:read,signatures");
Route::match(['put','patch','options'],'/signatures/{signature}','Signatures\SignatureOperationController@save_changes')->middleware("checkrole:modify,signatures");
Route::delete('/signatures/{signature}', 'Signatures\SignatureOperationController@delete')->middleware("checkrole:delete,signatures");
Route::post('/signatures/deleteall', 'Signatures\SignatureOperationController@deleteall')->middleware("checkrole:delete,signatures");