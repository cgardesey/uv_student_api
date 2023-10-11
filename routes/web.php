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

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


Route::get('/email/{email}/{token}', 'Auth\RegisterController@confirmEmail');
Route::get('/password/{token}', 'Auth\RegisterController@tPassword');
Route::get('register/confirm/{token}', function () {
    return View::make('flash');
});
Route::get('password-reset', function () {
    return View::make('flash');
});
Route::post('/password/reset', 'Auth\PasswordResetController@sendLink');
Route::get('/password/reset/{token}', 'Auth\PasswordResetController@show');
Route::post('/password', 'Auth\PasswordResetController@reset');

//Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');*/
