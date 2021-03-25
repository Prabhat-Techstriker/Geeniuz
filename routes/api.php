<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('forget-password', 'PasswordResetController@forgetPassword');

Route::group(['prefix' => 'password'], function() {
	Route::post('create', 'PasswordResetController@create');
	Route::get('find/{token}', 'PasswordResetController@find');
	Route::post('reset', 'PasswordResetController@reset');
});

Route::group(['middleware' => 'auth:api'], function() {
	Route::put('change-password', 'PasswordResetController@changePassword');
	Route::get('logout', 'AuthController@logout');
	Route::get('profile', 'AuthController@me');

	Route::get('user/{id}', 'UserController@singleUser');	
	Route::put('user/{id}', 'UserController@update');
	Route::post('user-update', 'UserController@updateUser');
	Route::get('users', 'UserController@allUsers');
	Route::post('search-users', 'UserController@searchUser');
	Route::delete('delete-user/{id}', 'UserController@delete');
	Route::post('save-business', 'UserController@saveBusinesses');
	Route::post('list-save-business', 'UserController@listSavedbusiness');
	Route::post('list-all-business', 'UserController@listAllbusiness');
	Route::post('reviews-list', 'UserController@reviewsList');
	Route::post('list-feeds', 'UserController@feedsList');
	Route::post('list-posts', 'UserController@postsList');
	Route::post('count-in-profile', 'UserController@countsInprofile');
	Route::post('existinncommunity', 'UserController@existIncommunity');
	Route::post('awards-list', 'UserController@awardsList');
	Route::post('push', 'UserController@push');

	Route::get('categories', 'CategoryController@show');
	Route::post('create-category', 'CategoryController@create');
	Route::put('update-category/{id}', 'CategoryController@update');
	Route::delete('delete-category/{id}', 'CategoryController@delete');
	Route::get('getCat/{id}', 'CategoryController@getCat');
	Route::get('getSubCat/{id}', 'CategoryController@getSubCat');
	Route::post('businesses-by-category/{id}', 'CategoryController@showBusinessesByCat');

	Route::post('create-business', 'BusinessController@create');
	/*Route::get('all-businesses', 'BusinessController@show');*/ // Old Route
	Route::post('all-businesses', 'BusinessController@show');
	Route::get('business-detail/{id}', 'BusinessController@detail');
	Route::delete('business-delete/{id}', 'BusinessController@delete');

	Route::post('update-business/{id}', 'BusinessController@update');

	Route::post('business-recommendation', 'BusinessController@businessRecommendation');
	Route::post('business-checkins', 'BusinessController@businessCheckIns');
	Route::post('image-remove', 'BusinessController@imageRemove');

	Route::post('create-review', 'ReviewController@create');
	Route::post('list-review', 'ReviewController@create');

	Route::post('create-community', 'CommunitiesController@create');
	Route::get('community-list', 'CommunitiesController@show');
	Route::post('create-feed', 'CommunitiesController@createFeed');
	Route::post('create-feed-comment', 'CommunitiesController@feedComments');
	Route::post('get-feed-comment', 'CommunitiesController@getfeedComments');
	Route::post('like-dislike-feed', 'CommunitiesController@likeDislike');
	Route::post('get-all-feeds', 'CommunitiesController@getallFeed');
	Route::get('get-likes-count', 'CommunitiesController@getLikescount');
	Route::post('delete-community', 'CommunitiesController@delete');
	Route::post('add-usersto-community', 'CommunitiesController@addUsertocommunity');
	Route::post('add-in-community', 'CommunitiesController@addincommunitybyhimself');
	Route::post('delete-usersfrom-community', 'CommunitiesController@deleteUsertocommunity');
	Route::post('left-community', 'CommunitiesController@leftCommunity');

	Route::post('create-suggetions', 'SuggetionsController@create');
	Route::get('all-suggetions', 'SuggetionsController@show');
	Route::delete('delete-suggetion/{id}', 'SuggetionsController@destroy');

	Route::post('claim-business', 'ClaimbusinessController@claimBusiness');
	Route::get('list-all-claims', 'ClaimbusinessController@listAllclaims');
	Route::post('approval-claims', 'ClaimbusinessController@claimApproval');

	Route::post('add-contact', 'ContactlistController@Create');
	Route::post('followers', 'ContactlistController@followerList');
	Route::post('contact-business', 'ContactlistController@contactBusiness');

	Route::post('search', 'SearchController@Search');

	Route::post('pushnotification', 'PushnotificationController@create');
	Route::get('list-pushnotification', 'PushnotificationController@show');
});
