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

Route::prefix('profiles')->group(function(){
	Route::get('/show_login_form', 'ProfileController@showLoginForm')->name('profiles.show_login_form');
	Route::post('/login', 'ProfileController@login')->name('profiles.login');
	Route::get('/{user}/edit', 'ProfileController@edit')->name('profiles.edit');
	Route::patch('/{user}', 'ProfileController@update')->name('profiles.update');
});

Route::prefix('manage')->group(function(){		
	Route::resource('/permissions', 'PermissionController',['as' => 'manage']);
	Route::resource('/roles', 'RoleController',['as' => 'manage']);
	Route::get('/roles/{role}/assign_permissions_form', 'RoleController@assignPermissionsForm')->name('manage.roles.assign_permissions_form');
	Route::post('/roles/{role}/assign_permissions', 'RoleController@assignPermissions')->name('manage.roles.assign_permissions');
	Route::resource('/users', 'UserController',['as' => 'manage']);
	Route::get('/users/{user}/assign_roles_form', 'UserController@assignRolesForm')->name('manage.users.assign_roles_form');
	Route::post('/users/{user}/assign_roles', 'UserController@assignRoles')->name('manage.users.assign_roles');
	Route::get('/', 'ManageController@index')->name('manage.index');	
});

Route::get('/home', 'HomeController@index')->name('home');
