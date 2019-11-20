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
        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::get('ChallengeView', 'ChallengeController@list')->name('ChallengeList');
            Route::get('solvedUsers', 'ChallengeController@solvedUsers')->name('solvedUsers');
            Route::group(['middleware' => 'jwt.auth'], function () {

                Route::get('category', 'ChallengeController@category')->name('ChallengeCategory');
                Route::post('SubmitFlag', 'ChallengeController@SubmitFlag')->name('ChallengeSubmitFlag');
                Route::post('ChallengeRank', 'ChallengeController@ChallengeRank')->name('ChallengeRank');

                Route::group(['middleware' => 'jwt.admin'], function () {
                    Route::post('create', 'ChallengeController@create')->name('ChallengeCreate');  //需要管理员
                    Route::post('CreateChallenge', 'ChallengeController@CreateChallenge')->name('CreateChallenge');      //创建测试题目
                    Route::post('DeleteChallenge', 'ChallengeController@DeleteChallenge')->name('DeleteChallenge');
                    Route::post('UpdateChallenge', 'ChallengeController@UpdateChallenge')->name('UpdateChallenge');
                });
            });
        });
    });


    Route::prefix('Examination')->group(function (){
        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::get('getExam', 'ExaminationController@getExam')->name('getExam');
            Route::get('Abandon', 'ExaminationController@AbandonExam')->name('AbandonExam');
            Route::get('Status', 'ExaminationController@Status')->name('ExamStatus');
            Route::post('SubmitAnswer', 'ExaminationController@SubmitAnswer')->name('SubmitAnswer');
            Route::get('test', 'ExaminationController@test')->name('test');

            //Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('AddExam', 'ExaminationController@AddExam')->name('AddExam');
            Route::get('DelExam', 'ExaminationController@DelExam')->name('DelExam');
            Route::get('ExamList', 'ExaminationController@ExamList')->name('ExamList');
            Route::post('UpdateExam', 'ExaminationController@UpdateExam')->name('UpdateExam');
            //});
        });
    });



    Route::prefix('SelectChallenge')->group(function() {
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('addChoiceQuestionToExam', 'SelectChallengeController@addChoiceQuestionToExam')->name('addChoiceQuestionToExam');
            Route::get('delChoiceQuestionFromExam','SelectChallengeController@delChoiceQuestionFromExam')->name('SelectChallengeController@');
            Route::post("updateChoiceQuestion","SelectChallengeController@updateChoiceQuestion")->name('updateChoiceQuestion');
            Route::get('CreateTest', 'SelectChallengeController@CreateTestSelectChallenge')->name('CreateTestSelectChallenge');
        });
    });

    /*
     * Category 题目类型
     */
    Route::prefix('category')->group(function(){
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('AddCategory', 'CategoryController@add')->name('AddCategory');
            Route::get('DelCategory', 'CategoryController@del')->name('DelCategory');
            Route::get('CategoryList','CategoryController@list')->name('CategoryList');
        });


    });
    /*
     *  Bulletin 公告
     */
    Route::prefix('Bulletin')->group(function (){
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('add', 'BulletinController@add')->name('AddBulletin');
            Route::post('del', 'BulletinController@del')->name('DelBulletin');
            Route::post('EditBulletin','BulletinController@edit')->name('EditBulletin');
        });
        Route::get('list','BulletinController@list')->name('BulletinList');

    });


    Route::prefix('course')->group(function() {
        Route::get('CourseList', 'CourseController@CourseList')->name(' CourseList');
        Route::get('CourseInfo', 'CourseController@CourseInfo')->name('CourseInfo');

        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('AddCourse', 'CourseController@AddCourse')->name('AddCourse');
            Route::post('DelCourse', 'CourseController@DelCourse')->name('DelCourse');
            ROute::post('UpdateCourse', 'CourseController@UpdateCourse')->name('UpdateCourse');
            Route::get('CreateTestCourse', 'CourseController@CreateTestCourse')->name('CreateTestCourse'); //创建测试课程
        });
    });

    Route::prefix('CourseCategory')->group(function() {

        Route::get('CourseList','CoursecategoryController@list')->name('CourseList');   //用户课程展示
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::get('AllCourseList', 'CoursecategoryController@AllCourseInfo')->name('AllCourseInfo');
            Route::post('createCategory','CoursecategoryController@createCategory')->name('createCategory');
            Route::post('delCategory','CoursecategoryController@delCategory')->name('delCategory');
            Route::post('updateCategory','CoursecategoryController@update')->name('updateCategory');
            //CourseCategory/delCategory
        });
    });

    Route::prefix('chapter')->group(function() {
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::get('ChapterList','ChapterController@list')->name('ChapterList');
            Route::post('addChapter', 'ChapterController@add')->name('addChapter');
            Route::post('delChapter', 'ChapterController@delete')->name('delChapter');
            Route::post('UpdateChapter','ChapterController@update')->name('UpdateChapter');
        });
    });


    Route::prefix('video')->group(function() {
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::post('AddVideo', 'VideoController@add')->name('addVideo');
            Route::post('DelVideo', 'VideoController@delete')->name('delVideo');
            Route::post('EditVideo','VideoController@edit')->name('EditVideo');
        });
    });

    Route::prefix('Examlog')->group(function() {
        Route::group(['middleware' => 'jwt.admin'], function () {
            Route::get('ExamLog', 'ExamlogController@list')->name('ExamLog');
            Route::get('Examdel', 'ExamlogController@del')->name('Examdel');
        });
    });

});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
