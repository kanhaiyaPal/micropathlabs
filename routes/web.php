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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/nopermission', 'HomeController@nopermission');

Route::get('/globalsettings', 'Globals\SettingsController@index')->middleware("checkrole:view,global_settings");
Route::post('/saveglobalsettings', 'Globals\SettingsController@save')->middleware("checkrole:modify,global_settings");

Route::get('/patients', 'Patients\PatientOperationController@showpatienteditform')->middleware("checkrole:view,patient");
Route::get('/patient/register', 'Patients\PatientOperationController@showpatientregisterform')->middleware("checkrole:write,patient");
Route::get('/patient/{patient}', 'Patients\PatientOperationController@showpatienteditform')->middleware("checkrole:read,patient");
Route::match(['put','patch','options'],'/patient/{patient}','Patients\PatientOperationController@saveexistingpatient')->middleware("checkrole:update,patient");
Route::delete('/patient/{patient}', 'Patients\PatientOperationController@showpatienteditform')->middleware("checkrole:delete,patient");