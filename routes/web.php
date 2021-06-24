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
session_start();
Route::get('/', "Auth\AuthController@show")->name("login");
Route::post('/logins', "Auth\AuthController@loginKeun")->name("login_validation");
Route::get('/logout', "Auth\AuthController@logoutKeun")->name("logout");

Route::group(["middleware" => "login_check"], function () {

    Route::get('saw/get-kriteria','MainController@getKriteria')->name("getKriteria");
    Route::post('saw/save-kriteria','MainController@saveKriteria')->name('saveKriteria');

    Route::get('saw/get-nilaicrips','MainController@getNilaiCrips')->name("getNilaiCrips");
    Route::post('saw/save-nilaicrips','MainController@saveNilaiCrips')->name('saveNilaiCrips');

    Route::get('saw/get-alternatif','MainController@getAlternatif')->name("getAlternatif");
    Route::post('saw/save-alternatif','MainController@saveAlternatif')->name('saveAlternatif');

    Route::get('saw/get-nilai-alternatif','MainController@getNilaiAlternatif')->name("getNilaiAlternatif");
    Route::post('saw/save-nilai-alternatif','MainController@saveNilaiAlternatif')->name('saveNilaiAlternatif');

    Route::post('saw/delete-all','MainController@deleteAll')->name('deleteAll');

    Route::get('{role}/{pages}', "MainController@show_page")->name("show_page");
});
