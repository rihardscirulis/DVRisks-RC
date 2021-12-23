<?php

use Illuminate\Support\Facades\Route;

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
    return view('application.index');
});

Route::get('/sakums', function () {
    return view('welcome.index');
});


Route::resource('faktors', 'FactorController');
Route::resource('risks', 'RiskController');
Route::resource('faktoragrupa', 'FactorGroupController');
Route::resource('izveidotdokumentu', 'CreateDocumentController');
Route::resource('iestade', 'AuthorityController');
Route::resource('vide', 'EnvironmentController');
Route::resource('amats', 'PositionController');
Route::resource('personals', 'StaffController');
Route::resource('pasakuma_plans', 'CreateEventDocumentController');

Auth::routes();

Route::post('faktors', 'FactorController@store');
Route::post('faktoragrupa', 'FactorGroupController@store');
Route::post('/izveidotdokumentu', 'CreateDocumentController@store');

Auth::routes();
