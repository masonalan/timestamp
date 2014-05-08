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
/*App::missing(function($exception)
{
	$titlePage = 'Error';
    return Redirect::to('notfound');
});
*/


/**
* Model Binding
*/
Route::model('post', 'Post');

/**
 * HomeController
 */

Route::get('/', 'HomeController@splash');
Route::group(array('before' => 'auth.basic'), function() {
Route::post('/subscribe', 'HomeController@subscribe');
Route::get('/qwertytest', 'HomeController@start');

/**
 * AuthController
 */


Route::post('/register', 'AuthController@handleRegister');
Route::get('/login', 'AuthController@login');
Route::post('/handleLogin', 'AuthController@handleLogin');
Route::get('/logout', 'AuthController@logout');

/**
 * FeedController
 */

Route::get('/feed', 'FeedController@feed');
Route::post('/post/reply/{post}', 'PostController@reply');

/**
 * PostController
 */

Route::post('/like', 'PostController@like');
Route::post('/check', 'PostController@check');
Route::get('/post/{id}', 'PostController@focus');

/**
 * UserController
 */

Route::get('/profile/{id}', 'UserController@profile');
Route::get('/u/{username}', 'UserController@gui_prof');
Route::post('/profile/handleUpload', 'UserController@handleUpload');
Route::get('/settings', 'UserController@settings');
Route::post('/handleAbout', 'UserController@handleAbout');
Route::post('/handleFollow', 'UserController@handleFollow');
Route::get('/follow/{user_id}', 'UserController@followUser');
Route::get('/unfollow/{user_id}', 'UserController@unfollowUser');
Route::get('/notfound', 'UserController@notfound');
Route::get('/intended', 'UserController@back');
Route::get('/profile/{id}/followers', 'UserController@detailFollowers');
Route::get('/profile/{id}/following', 'UserController@detailFollowing');
Route::post('handleDetails', 'UserController@handleDetails');
Route::post('/handlepsswd', 'UserController@handlePChange');

/**
 *WorldController (Controls the map and world fucntions)
 */
Route::get('/world', 'WorldController@world');

/**
*for searching shit
*/

Route::post('search/handler/ngjp', 'SearchController@handleSearch');
Route::get('/search/{type}/{query}', 'SearchController@search');
Route::get('location/{id}', 'LocationController@location_list');

/**
*helping users
*/
Route::get('/timestamp/help', 'HelpController@helper_new');

/**
* Testing the 404 route
*/
Route::get('/notfound', function() {
	return View::make('404');
});
});