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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function(){
	
	Route::get('/admin', 'AdminController@index')->name('admin.index');
	
/*** All the Posts Routes ****/
	Route::get('/admin/posts', 'PostController@index')->name('post.index');
	Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
	Route::post('/admin/posts', 'PostController@store')->name('post.store');
	Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
	Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');
	Route::delete('/admin/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
	
	
/*** All the Users Routes ****/
	Route::delete('admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');
	
});

/** Middlewares *****/

Route::middleware(['role:ADMIN', 'auth'])->group(function(){
	
	Route::get('admin/users', 'UserController@index')->name('user.index');
	
	Route::put('admin/user/{user}/attach', 'UserController@attach')->name('user.role.attach');
	
	Route::put('admin/user/{user}/detach', 'UserController@detach')->name('user.role.detach');
	
	
});

Route::middleware(['auth', 'can:view,user'])->group(function(){
	
	Route::get('admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
	
	Route::put('admin/users/{user}/update', 'UserController@update')->name('user.profile.update');
	
	
});


Route::middleware(['auth', 'role:ADMIN'])->group(function(){
	
/*** Routes for Roles Model ***/
	Route::get('admin/roles', 'RoleController@index')->name('role.index');
	
	Route::post('admin/roles', 'RoleController@store')->name('role.store');
	
	Route::delete('admin/roles/{role}/destroy', 'RoleController@destroy')->name('role.destroy');
	
	Route::get('admin/roles/{role}/edit', 'RoleController@edit')->name('role.edit');
	
	Route::put('admin/roles/{role}/update', 'RoleController@update')->name('role.update');
	 
	Route::put('admin/roles/{role}/attach', 'RoleController@permission_attach')->name('role.permission.attach');
	
	Route::put('admin/roles/{role}/detach', 'RoleController@permission_detach')->name('role.permission.detach');

});

Route::middleware(['auth', 'role:ADMIN'])->group(function(){
	
/*** Routes for Permissions Model ***/
	Route::get('admin/permissions', 'PermissionController@index')->name('permission.index');
	
	Route::post('admin/permissions', 'PermissionController@store')->name('permission.store');
	
	Route::get('admin/permissions/{permission}/edit', 'PermissionController@edit')->name('permission.edit');
	
	Route::put('admin/permissions/{permission}/update', 'PermissionController@update')->name('permission.update');
	
	Route::delete('admin/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permission.destroy');
	
});