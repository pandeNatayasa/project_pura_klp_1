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
Route::get('/member/activation/{token}','Auth\RegisterController@userActivation');

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
Route::post('/fetch-province-in-edit','Admin\SubDistrictController@fetch_province_in_edit')->name('fetch_province_in_edit');
Route::post('/fecth-location-in-sub-district','Admin\SubDistrictController@fetch')->name('fetch_location_sub_district');

// Route Admin => Wuku
Route::resource('/admin/wuku','Admin\WukuController');

// Route Admin => Saptawara
Route::resource('/admin/saptawara','Admin\SaptawaraController');

// Route Admin => Pancawara
Route::resource('/admin/pancawara','Admin\PancawaraController');

// Route Admin => Sasih
Route::resource('/admin/sasih','Admin\SasihController');

// Route Admin => Rahinan
Route::resource('/admin/rahinan','Admin\RahinanController');

// Route Admin => Temple Type
Route::resource('/admin/temple-type','Admin\TempleTypeController');

// User
Route::get('/', 'UserController@maps');
Route::get('/user/add_temple', 'UserController@add_temple')->name('add_temple');
Route::post('/fetch_data','UserController@fetch')->name('fetch_data');
Route::get('/loadMarker','UserController@loadMarker');
Route::post('/dropzone','UserController@dropzone')->name('dropzone');
Route::get('/user/profile','UserController@profile')->name('user.profile');

// TEMPLE TYPE
Route::resource('/temple-type','TempleTypeController');

// TEMPLE 
Route::resource('/temple','TempleController');
Route::post('/fecth-location','TempleController@fetch')->name('fetch_location');

// Route::get('/xxx/{username?}', function ($username) {
//     return 'hai '.$username;
// });

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/validasi', function () {
    return view('admin.validate');
});


