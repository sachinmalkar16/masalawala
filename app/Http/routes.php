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

// OAuth, Login and Signup Routes.
Route::post('auth/twitter', 'AuthController@twitter');
Route::post('auth/facebook', 'AuthController@facebook');
Route::post('auth/foursquare', 'AuthController@foursquare');
Route::post('auth/instagram', 'AuthController@instagram');
Route::post('auth/github', 'AuthController@github');
Route::post('auth/google', 'AuthController@google');
Route::post('auth/linkedin', 'AuthController@linkedin');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/signup', 'AuthController@signup');
Route::get('auth/unlink/{provider}', ['middleware' => 'auth', 'uses' => 'AuthController@unlink']);

// API Routes.
Route::get('api/me', ['middleware' => 'auth', 'uses' => 'UserController@getUser']);
Route::put('api/me', ['middleware' => 'auth', 'uses' => 'UserController@updateUser']);

// Initialize Angular.js App Route.
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'api/product'], function()
{
    Route::get('count_products',[
        'uses' => 'ProductController@count'
    ]);
    Route::get('list/{offset}/{limit}',[
        'uses' => 'ProductController@getProducts'
    ]);
    Route::get('{id}',[
        'uses' => 'ProductController@getProductById'
    ]);
    Route::get('reviews/{id}',[
        'uses' => 'ProductController@reviews'
    ]);
    Route::post('update/{id}',[
        'uses' => 'ProductController@update'
    ]);
    Route::post('create',[
        'uses' => 'ProductController@create'
    ]);
    Route::post('delete/{id}',[
        'uses' => 'ProductController@delete'
    ]);

    Route::post('upload_image/{id}',[
        'uses' => 'ProductController@uploadImage'
    ]);
    Route::post('remove_image/{product_id}/{image_id}',[
        'uses' => 'ProductController@removeImage'
    ]);
    Route::post('save_review/{id}',[
        'uses' => 'ProductController@storeReviewForProduct'
    ]);
});


Route::group(['prefix' => 'api/categories'], function()
{
    Route::get('list',[
        'uses' => 'CategoriesController@getList'
    ]);
});


Route::get('images/{product_id}/{image}', function($product_id =null, $image = null)
{
    $path = storage_path().'/app/public/products/'. $product_id .'/' . $image;
    if (file_exists($path)) {
        return Response::download($path);
    }
});