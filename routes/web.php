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
// Authentication Routes
Route::get('auth/login', ['as' => 'auth.login', 
		'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', ['as' => 'auth.logout', 
		'uses' => 'Auth\LoginController@logout']);

// Registration Routes
Route::get('auth/register',
	 'Auth\RegisterController@showRegistrationForm');
Route::post('auth/register', 'Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset/{token?}',
	['as' => 'password.reset', 
	'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/email',
	 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/forgot', 
	'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/reset','Auth\ResetPasswordController@reset' );

// Categories Routes
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

// Comments
Route::post('comments/{post_id}', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
Route::get('comments/{id}/edit', ['as' => 'comments.edit', 'uses' => 'CommentsController@edit']);
Route::put('comments/{id}', ['as' => 'comments.update', 'uses' => 'CommentsController@update']);
Route::delete('comments/{id}', ['as' => 'comments.destroy', 'uses' => 'CommentsController@destroy']);
Route::get('comments/{id}/delete', ['as' => 'comments.delete', 'uses' => 'CommentsController@delete']);

// Tags Routes
Route::resource('tags', 'TagController', ['except' => ['create']]);

Route::get('blog/{slug}', ['as' => 'blog.single', 
		'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex',
	 	'as' => 'blog.index']);
Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', ['as' => 'pages.contact', 'uses' => 'PagesController@postContact']);
Route::get('/', 'PagesController@getIndex');
Route::get('home', 'PagesController@getIndex');

Route::resource('posts', 'PostController');

