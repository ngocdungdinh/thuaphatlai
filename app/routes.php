<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(array('prefix' => 'admin'), function()
{

	# Blog Management
	Route::group(array('prefix' => 'blogs'), function()
	{
		Route::get('/', array('as' => 'blogs', 'uses' => 'Controllers\Admin\BlogsController@getIndex'));
		Route::get('create', array('as' => 'create/blog', 'uses' => 'Controllers\Admin\BlogsController@getCreate'));
		Route::post('create', 'Controllers\Admin\BlogsController@postCreate');
		Route::get('{blogId}/edit', array('as' => 'update/blog', 'uses' => 'Controllers\Admin\BlogsController@getEdit'));
		Route::post('{blogId}/edit', 'Controllers\Admin\BlogsController@postEdit');
		Route::get('{blogId}/delete', array('as' => 'delete/blog', 'uses' => 'Controllers\Admin\BlogsController@getDelete'));
		Route::get('{blogId}/restore', array('as' => 'restore/blog', 'uses' => 'Controllers\Admin\BlogsController@getRestore'));
        Route::post('setcover', 'Controllers\Admin\BlogsController@postSetCover');
	});

	# User Management
	Route::group(array('prefix' => 'users'), function()
	{
		Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
		Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
		Route::post('create', 'Controllers\Admin\UsersController@postCreate');
		Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
		Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
		Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
		Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
	});

	# Group Management
	Route::group(array('prefix' => 'groups'), function()
	{
		Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
		Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
		Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
		Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
		Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
		Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
		Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
	});
    
    # Categories Management
	Route::group(array('prefix' => 'categories'), function()
	{
		Route::get('/', array('as' => 'categories', 'uses' => 'Controllers\Admin\CategoriesController@getIndex'));
		Route::get('create', array('as' => 'create/category', 'uses' => 'Controllers\Admin\CategoriesController@getCreate'));
		Route::post('create', 'Controllers\Admin\CategoriesController@postCreate');
		Route::get('{catId}/edit', array('as' => 'update/category', 'uses' => 'Controllers\Admin\CategoriesController@getEdit'));
		Route::post('{catId}/edit', 'Controllers\Admin\CategoriesController@postEdit');
		Route::get('{catId}/delete', array('as' => 'delete/category', 'uses' => 'Controllers\Admin\CategoriesController@getDelete'));
	});
    
    # Tags Management
	Route::group(array('prefix' => 'tags'), function()
	{
		Route::get('/', array('as' => 'tags', 'uses' => 'Controllers\Admin\TagsController@getIndex'));
		Route::get('/listpopup', array('as' => 'list/tag', 'uses' => 'Controllers\Admin\TagsController@getIndexPopup'));
		Route::post('addposts', 'Controllers\Admin\TagsController@postAddPost');
		Route::get('create', array('as' => 'create/tag', 'uses' => 'Controllers\Admin\TagsController@getCreate'));
		Route::post('ajaxcreate', 'Controllers\Admin\TagsController@postCreateTag');
		Route::get('ajaxlist', 'Controllers\Admin\TagsController@getAjaxList');
		Route::get('removepost', array('as' => 'removepost/tag', 'uses' => 'Controllers\Admin\TagsController@removePost'));
		Route::post('create', 'Controllers\Admin\TagsController@postCreate');
		Route::get('{tagId}/edit', array('as' => 'update/tag', 'uses' => 'Controllers\Admin\TagsController@getEdit'));
		Route::post('{tagId}/edit', 'Controllers\Admin\TagsController@postEdit');
		Route::get('{tagId}/delete', array('as' => 'delete/tag', 'uses' => 'Controllers\Admin\TagsController@getDelete'));
	});

    # Image upload
    Route::get('/upload', 'ImageController@getUploadForm');
    Route::post('/upload/image','ImageController@postUpload');

	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function()
{

	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'account'), function()
{

	# Account Dashboard
	Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

	# Profile
	Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
	Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

	# Change Password
	Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
	Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

	# Change Email
	Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
	Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});

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
/*
|--------------------------------------------------------------------------
| Medias Routes
|--------------------------------------------------------------------------
*/
Route::get('medias/upload', 'MediasController@getUpload');
Route::post('medias/upload', 'MediasController@postUpload');
Route::post('medias/{mediaId}/delete', 'MediasController@postDelete');
Route::get('medias/my', 'MediasController@getMy');
Route::get('medias/index', 'MediasController@getIndex');

Route::get('about-us', function()
{
	//
	return View::make('frontend/about-us');
});

Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
Route::post('contact-us', 'ContactUsController@postIndex');

#Route::get('blog/{postSlug}', array('as' => 'view-post', 'uses' => 'BlogController@getView'));
#Route::post('blog/{postSlug}', 'BlogController@postView');
Route::get('{catSlug}/{postSlug}', array('as' => 'view-post', 'uses' => 'BlogController@getView'))
	->where(array('catSlug' => '[A-Za-z0-9\-]+', 'postSlug' => '[A-Za-z0-9\-]+'));

Route::get('{catSlug}', array('as' => 'view-category', 'uses' => 'BlogController@getCategory'))
	->where(array( 'catSlug' => '[A-Za-z0-9\-]+'));

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showIndex'));
