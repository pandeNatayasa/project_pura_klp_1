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
Route::post('/member/register', 'Auth\RegisterController@register_member')->name('member.register');
Route::get('/member/activation/{token}','Auth\RegisterController@userActivation');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/member/logout','Auth\LoginController@logout')->name('member.logout');

// Route Admin =>Registration
Route::get('/admin/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');

Route::get('/admin/master-data', 'Admin\AdminController@index')->name('admin.master-data');
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
Route::get('/', 'LandingController@maps')->name('landing');
Route::get('/user', 'UserController@maps')->name('user');
Route::get('/user/add-temple', 'UserController@add_temple')->name('add_temple');
Route::post('/fetch_data','UserController@fetch')->name('fetch_data');
Route::get('/loadMarker','LandingController@loadMarker');
Route::post('/change_password','UserController@change_password');
Route::post('/dropzone','UserController@dropzone')->name('dropzone');
Route::get('/user/profile','UserController@profile')->name('user.profile');
Route::post('/user/update-foto-profille','UserController@update_foto_profille')->name('user.update-foto-profille');
Route::put('/edit/profile/{id}','UserController@edit_profile')->name('edit.profile');
Route::get('/user/contribution','UserController@contribution')->name('user.contribution');
Route::get('/user/contribution-detail/{id}','UserController@contribution_details');

// TEMPLE TYPE
Route::resource('/temple-type','Admin\TempleTypeController');

// TEMPLE 
Route::resource('/user/temple','TempleController');
Route::post('/fecth-location','TempleController@fetch')->name('fetch_location');

// Route::get('/xxx/{username?}', function ($username) {
//     return 'hai '.$username;
// });


// Route Admin => Dashboard
Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.home');
Route::get('/admin/validate', 'Admin\DashboardController@show_list_temple_validate')->name('show_list_temple_validate');
Route::get('/admin/list-temple','Admin\DashboardController@show_list_temple')->name('show_list_temple');
Route::get('/admin/verify-accept-temple/{id}','Admin\DashboardController@verify_accept_temple');
Route::get('/admin/verify-reject-temple/{id}','Admin\DashboardController@verify_reject_temple');
Route::get('/admin/temple-detail/{id}','Admin\DashboardController@show_temple_detail')->name('show_temple_detail');
Route::get('/admin/update-temple/{id}','Admin\DashboardController@update_temple')->name('admin.update_temple');
Route::get('/admin/profille','Admin\DashboardController@show_profille_admin')->name('show_profille_admin');
Route::put('/admin/profille/{id}','Admin\DashboardController@update_profille_admin')->name('update_profille_admin');


