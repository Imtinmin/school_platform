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
        //Route::get('token/{token}','UserController@tokenVerify')->name('tokenVerify');
        Route::get('rank','UserController@getRanking')->name('UserRank');

        /*
         * 需要jwt-token
         */
        Route::group(['middleware' => 'jwt.auth'], function () {
            //Route::get('logout','UserController@logout')->name('UserLogout');
            Route::get('profile','UserController@getAuthInfo')->name('UserInfo');
            Route::post('password/reset','UserController@resetPassword')->name('ResetPassword');
            Route::get('select','UserController@SelectUser')->name('SelectUser');
        });

    });

    /*
     * Challenge
     */
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::prefix('challenge')->group(function () {
            Route::post('create', 'ChallengeController@create')->name('ChallengeCreate')->middleware('jwt.admin');
            Route::get('list', 'ChallengeController@list')->name('ChallengeList');
            Route::get('category', 'ChallengeController@category')->name('ChallengeCategory');
        });
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


    Route::prefix('admin')->group(function () {
        Route::post('','Controller@update')->name('UpdateAdmin');
    });
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
