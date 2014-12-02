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

Route::get('authors', array('uses'=>'AuthorController@index'));

Route::get('videos/{countryId}/{categoryId}', array('uses'=>'HomeController@videos'));

Route::get('play/{videoId}/{partNumber?}', array("uses" => "HomeController@getPlay"));

Route::get('search', array("uses" => "HomeController@getSearch"));

// Testing user table
Route::get('user/test', array('uses' => 'UserController@getTest'));


/*
/ Unauthentication Group
*/
Route::group(array("before" => "guest"), function(){

	// CSRF protection group
	Route::group(array("before" => "csrf"), function(){

		Route::post("/user/signup", array("uses" => "UserController@postSignup"));

		Route::post("/user/signin", array("uses" => "UserController@postSignin"));

	});

	Route::get("/user/signup", array("uses" => "UserController@getSignup"));

	Route::get("/user/signin", array("uses" => "UserController@getSignin"));

	Route::get("/user/activate/{activationCode}", array("uses" => "UserController@getActivate"));

	// facebook log in
	Route::get("login/fb", array("uses" => "FacebookController@getLogin"));
	Route::get("login/fb/callback", array("uses" => "FacebookController@getLoginCallback"));

});


/*
/ Authentication Group
*/
Route::group(array("before" => "auth"), function(){
	//CSRF protection group
	Route::group(array("before" => "csrf"), function(){
		Route::post("/admin/upload", array("uses" => "AdminController@postUpload"));
	});

	Route::get("/admin/upload", array("uses" => "AdminController@getUpload"));

	Route::get("/user/signout", array("uses" => "UserController@getSignout"));

	Route::get("/user/secure", array("uses" => "UserController@getSecure"));
});


/*
/ Testing restful api route
*/

Route::resource('posts', 'PostsController');