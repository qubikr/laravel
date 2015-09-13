<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*
Route::get('/admin/login', 
	array(
//		'as' 		=> 'admin.login',
		'namespace' => 'Admin',
		'uses' 		=> 'AuthController@login',
	)
);
*/
Route::group(
	array(
		'prefix' 	 => 'admin',
		'namespace'  => 'Admin',
		'middleware' => 'admin.auth',
	),
	 function()
	{

		Route::controller(
			'auth', 'AuthController', 
			array(
				'getLogin'  => 'admin.loginForm',
				'postLogin' => 'admin.login',
				'anyLogout' => 'admin.logout',
			)
		);

		Route::resource(
			'user', 'User\UserController'
		);

		Route::get('region/page/', function(){
			return redirect(route('admin.region.index') . '/page/1');
		});

		Route::get('region/page/{page?}', 
			array(
				'as'   => 'admin.region.index',
				'uses' => 'RegionController@index',
			)
		);
		Route::resource(
			'region', 'RegionController'
		);

		Route::get('symptom/page/', function(){
			return redirect(route('admin.symptom.index') . '/page/1');
		});

		Route::get('symptom/page/{page}',
			array(
				'as'    => 'admin.symptom.index',
				'uses'  => 'SymptomController@index',
			)
		);

		Route::resource(
			'symptom', 'SymptomController'
		);	

		Route::get(
			'/',
			array(
				'as' => 'admin.index', 
				'uses' => 'IndexController@index'
			)
		);
	}
); 	