<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'HomeController@index'));

Route::get('authors/{name}', array('uses'=>'AuthorController@index'));

Route::get('videos/{countryId}/{categoryId}', array('uses'=>'HomeController@videos'));

Route::get('play/{videoId}/{partNumber?}', array("uses" => "HomeController@getPlay"));


/*
/ Unauthentication Group
*/
Route::group(array("before" => "guest"), function(){

	// CSRF protection group
	Route::group(array("before" => "csrf"), function(){

		Route::post("/user/create", array("uses" => "UserController@postCreate"));

		Route::post("/user/signin", array("uses" => "UserController@postSignin"));

	});

	Route::get("/user/create", array("uses" => "UserController@getCreate"));

	Route::get("/user/signin", array("uses" => "UserController@getSignin"));

});

/*
/ Authenticated Group
*/
Route::group(array("before" => "auth"), function(){
	Route::get("/user/signout", array("uses" => "UserController@getSignout"));

	Route::get("/user/secure", array("uses" => "UserController@getSecure"));
});