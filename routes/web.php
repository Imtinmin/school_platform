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
    return view('welcome');
});

Route::prefix('API')->group(function () {

    /*
     * user
     */
    Route::prefix('user')->group(function (){
        Route::post('login','UserController@login')->name('UserLogin');
        Route::post('register','UserController@register')->name('UserRegister');
        Route::get('token/{token}','UserController@tokenVerify')->name('tokenVerify');

        Route::group(['middleware' => 'api'], function () {
            Route::get('logout','UserController@logout')->name('UserLogout');
            Route::get('getAuthInfo','UserController@getAuthInfo')->name('UserInfo');
        });

    });
    /*
     * Challenge
     */
    Route::prefix('challenge')->group(function (){
        Route::post('create','ChallengeController@create')->name('ChallengeCreate');
        Route::get('list','ChallengeController@list')->name('ChallengeList');
        Route::get('category','ChallengeController@category')->name('ChallengeCategory');
    });
    /*
     * Category 题目类型
     */
    Route::prefix('category')->group(function(){
        Route::post('add','CategoryController@add')->name('AddCategory');
        Route::post('del','CategoryController@del')->name('DelCategory');
        Route::get('list','CategoryController@list')->name('CategoryList');
    });
    /*
     *  Bulletin 公告
     */
    Route::prefix('bulletin')->group(function (){
        Route::post('add','BulletinController@add')->name('AddBulletin');
        Route::post('del','BulletinController@del')->name('DElBulletin');
        Route::get('list','BulletinController@list')->name('BulletinList');
    });
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
