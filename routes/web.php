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
    if(Auth::check()){
   		return redirect('/home');
    }
    else{
    	return redirect('/login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/search', 'SearchController@index');
Route::get('/help', 'HelpController@index');


Route::group(['middleware' => 'auth'], function(){

	Route::get('/tows/preview', function(){
		return view('tows.edit');
	});

	Route::get('/account', 'AccountController@index');
	Route::post('/account','AccountController@update');

	Route::get('/photos/{photo}', 'PhotoController@show');
	Route::post('/photos/{photo}', 'PhotoController@update');
	Route::post('/photos/{photo}/upload', 'UploadController@store');

	Route::get('/tows', 'TowController@index');
	Route::get('/tows/{tow}', 'TowController@show');
	Route::get('/tows/{tow}/valid', 'TowController@tow_validator');
	Route::post('/tows/create', 'TowController@store');
	Route::post('/tows/{tow}/photos', 'PhotoController@store');
	Route::post('/tows/{tow}/children', 'TowController@add_child');
	Route::get('/tows/{tow}/edit', 'TowController@edit');
	Route::post('/tows/{tow}/archive', 'TowController@archive');
	Route::post('/tows/{tow}/release', 'TowController@release');
	Route::put('/tows/{tow}', 'TowController@update');
	Route::delete('/tows/{tow}', 'TowController@destroy');

	Route::get('/users', 'UserController@index');
	Route::get('/users/create', 'UserController@create');
	Route::post('/users/create', 'UserController@store');
	Route::get('/users/{user}', 'UserController@show');
	Route::get('/users/{user}/edit', 'UserController@edit');
	Route::post('/users/{user}/edit', 'UserController@update');
	Route::delete('/users/{user}', 'UserController@destroy');

	Route::get('/lots', 'LotController@index');
	Route::get('/lots/create', 'LotController@create');
	Route::post('/lots/create', 'LotController@store');
	Route::get('/lots/{lot}/edit', 'LotController@edit');
	Route::post('/lots/{lot}/edit', 'LotController@update');
	Route::delete('/lots/{lot}', 'LotController@destroy');

	Route::get('/contracts', 'ContractController@index');
	Route::get('/contracts/create', 'ContractController@create');
	Route::post('/contracts/create', 'ContractController@store');
	Route::get('/contracts/{contract}', 'ContractController@show');
	Route::get('/contracts/{contract}/edit', 'ContractController@edit');
	Route::post('/contracts/{contract}/edit', 'ContractController@update');
	Route::delete('/contracts/{contract}', 'ContractController@destroy');

	Route::get('/tags', 'TagController@index');
	Route::get('/tags/create', 'TagController@create');
	Route::post('/tags/create', 'TagController@store');
	Route::get('/tags/{tag}', 'TagController@show');
	Route::get('/tags/{tag}/edit', 'TagController@edit');
	Route::post('/tags/{tag}/edit', 'TagController@update');
	Route::get('/tags/{tag}/remove', 'TagController@destroy');

	Route::get('/reasons', 'ReasonController@index');
	Route::get('/reasons/create', 'ReasonController@create');
	Route::post('/reasons/create', 'ReasonController@store');
	Route::get('/reasons/{reason}', 'ReasonController@show');
	Route::get('/reasons/{reason}/edit', 'ReasonController@edit');
	Route::post('/reasons/{reason}/edit', 'ReasonController@update');

});




