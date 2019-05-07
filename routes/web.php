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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/member/login', 'Auth\LoginController@showLoginForm2')->name('member.login');
Route::get('/member/register', 'Auth\RegisterController@showRegisterForm2')->name('member.register');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/member/logout','Auth\LoginController@logout')->name('member.logout');

// Route Admin =>Registration
Route::get('/admin/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
Route::get('/admin/home', 'Admin\AdminController@index')->name('admin.home');
Route::post('/admin/login','AuthAdmin\LoginController@login')->name('admin.login.submit');
Route::get('/admin/logout','AuthAdmin\LoginController@logout')->name('admin.logout');

// Route Admin => Province
Route::resource('/admin/province','Admin\ProvinceController');

// Route Admin => City
Route::resource('/admin/city','Admin\CityController');

// Route Admin => SubDistrict
Route::resource('/admin/sub-district','Admin\SubDistrictController');
Route::post('/fetch-city-in-edit','Admin\SubDistrictController@fetch_city_in_edit')->name('fetch_city_in_edit');


// User
Route::get('/', 'UserController@maps');
Route::get('/user/add_temple', 'UserController@add_temple')->name('add_temple');
Route::post('/fetch_data','UserController@fetch')->name('fetch_data');
Route::post('/image-submit','UserController@imageUpload');

// TEMPLE TYPE
Route::resource('/temple-type','TempleTypeController');

// TEMPLE 
Route::resource('/temple','Member\TempleController');
Route::post('/fecth-location','Member\TempleController@fetch')->name('fetch_location');

// Route::get('/xxx/{username?}', function ($username) {
//     return 'hai '.$username;
// });

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


