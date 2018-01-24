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


//$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
//$this->post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


//Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix'    => 'admin',
    'as'        => 'admin.',
    'namespace' => 'Admin\\'
], function () {
    Route::name('login')->get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');

    Route::group([
        'middleware' => 'can:admin'
    ], function () {
        Route::name('logout')->post('logout', 'Auth\LoginController@logout');
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        });
    });
});

Route::get('/force-login', function () {
    \Auth::loginUsingId(1);
});