<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PhotoResource;

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

Route::get('/photo', function (Request $request) {
	$photo = App\Photo::find(1);
    return new PhotoResource($photo);
});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\AuthController@postLogin');
    Route::post('signup', 'Api\AuthController@setRegister');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
    	Route::get('showPhoto','Api\PhotoController@index');
    	Route::post('addPhoto/{id}','Api\PhotoController@store');
    	Route::post('updatePhoto/{id}','Api\PhotoController@update');
    	Route::post('removePhoto/{id}','Api\PhotoController@destroy');
    	Route::post('showAlbum','Api\AlbumController@index');
    	Route::post('addAlbum','Api\AlbumController@store');
    	Route::post('updateAlbum','Api\AlbumController@update');
    	Route::post('removeAlbum','Api\AlbumController@destroy');
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});
