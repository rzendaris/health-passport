<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('v1/login', 'API\v1\APIAuthController@login');
Route::post('v1/register', 'API\v1\APIAuthController@register');
Route::post('v1/forgot-password', 'API\v1\APIAuthController@forgotPassword');

    /**
     * API Version 1
     */
Route::group(['prefix' => 'v1'], function () {

    Route::group(['middleware' => 'auth.api'], function() {
            Route::get('logout', 'API\v1\APIAuthController@logout');
            Route::get('profile', 'API\v1\APIAuthController@user');
            Route::get('category', 'API\v1\AppsController@GetAppsCategory');
            /**
             * List Data
             */
            Route::get('infra-list', 'API\v1\AppsController@GetInfraList');
            Route::get('infra-list-recommendation', 'API\v1\AppsController@GetInfraListRecommendation');
            Route::get('infra-list-by-category/{category_id}', 'API\v1\AppsController@GetListByCategoryId');

            Route::post('spreadzone', 'API\v1\SpreadZoneController@index');
            Route::post('spreadzone/infra-list', 'API\v1\SpreadZoneController@spreadZoneInfraInfo');

            /**
             * Ads Management
             */
            Route::get('ads', 'API\v1\AdsController@GetAllAds');
    });
});
Route::any('{path}', function() {
    return response()->json([
        'message' => 'Route not found'
    ], 404);
})->where('path', '.*');
