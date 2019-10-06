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
        //Route::post('test','UserController@test');
        Route::post('login','UserController@login')->name('UserLogin');
        Route::post('register','UserController@register')->name('UserRegister');
        Route::get('rank','UserController@getRanking')->name('UserRank');

        Route::get('CreateTestUser','UserController@CreateTestUser')->name('CreateTestUser');
        Route::get('select','UserController@SelectUser')->name('SelectUser');
        /*
         * need jwt-token
         */
        Route::group(['middleware' => 'jwt.auth'], function () {
            //Route::get('logout','UserController@logout')->name('UserLogout');
            Route::get('profile','UserController@getAuthInfo')->name('UserInfo');
            Route::post('password/reset','UserController@resetPassword')->name('ResetPassword');

            Route::get('getSolvedChallenges','CtfachieveController@getSolvedChallenges')->name('getSolvedChallenges');

            Route::group(['middleware' => 'jwt.admin'], function () {
                Route::post('UpdateAdmin','UserController@UpdateAdmin')->name('UpdateAdmin');
                Route::post('DeleteUser','UserController@DeleteUser')->name('DeleteUser');
                Route::post('degrade','UserController@degrade')->name('degrade');
                Route::get('UserList','UserController@UserList')->name('UserList');

            });
        });

    });

    /*
     * Challenge
     */

    Route::prefix('challenge')->group(function () {
        Route::get('ChallengeView', 'ChallengeController@list')->name('ChallengeList');
        Route::get('solvedUsers','ChallengeController@solvedUsers')->name('solvedUsers');
        Route::group(['middleware' => 'jwt.auth'], function () {

            Route::get('category', 'ChallengeController@category')->name('ChallengeCategory');
            Route::post('SubmitFlag','ChallengeController@SubmitFlag')->name('ChallengeSubmitFlag');
            Route::post('ChallengeRank','ChallengeController@ChallengeRank')->name('ChallengeRank');

            Route::group(['middleware' => 'jwt.admin'], function () {
                Route::post('create', 'ChallengeController@create')->name('ChallengeCreate');  //需要管理员
                Route::get('CreateChallenge','ChallengeController@CreateChallenge')->name('CreateChallenge');      //创建测试题目
            });
        });
    });

    /*
     * Category 题目类型
     */
    Route::prefix('category')->group(function(){
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('AddCategory', 'CategoryController@add')->name('AddCategory');
            Route::post('DelCategory', 'CategoryController@del')->name('DelCategory');
        });

        Route::get('CategoryList','CategoryController@list')->name('CategoryList');
    });
    /*
     *  Bulletin 公告
     */
    Route::prefix('bulletin')->group(function (){
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('add', 'BulletinController@add')->name('AddBulletin');
            Route::post('del', 'BulletinController@del')->name('DElBulletin');
        });
        Route::get('list','BulletinController@list')->name('BulletinList');
    });


    Route::prefix('course')->group(function() {
        Route::get('CourseList','CourseController@CourseList')->name(' CourseList');
        Route::post('CourseInfo','CourseController@CourseInfo')->name('CourseInfo');
        Route::post('add','CourseController@AddCourse')->name('AddCourse');
        Route::get('CreateTestCourse','CourseController@CreateTestCourse')->name('CreateTestCourse');
    });

    Route::prefix('CourseCategory')->group(function() {
        Route::post('createCategory','CoursecategoryController@createCategory')->name('createCategory');
    });

});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
