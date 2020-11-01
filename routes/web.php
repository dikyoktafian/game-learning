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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return redirect('/member/login');
});

Route::get('member/login', 'Auth\MemberController@showLoginForm');
Route::post('member/login', 'Auth\MemberController@login');
Route::get('member/logout', 'Auth\MemberController@logout');



Route::group(['middleware' => 'members'], function() {
    Route::get('home', 'QuizController@index')->name('home');
    Route::get('/task', 'TaskController@index');
    Route::get('/task/{id}', 'TaskController@taskdetail');
    Route::post('/task/store', 'TaskController@storeAnswer');

    // Route::get('/materi', 'MateriController@index'); //sementara off
 });


 Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Route::get('/admin', function (){
    return redirect('/dashboard');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('settings', 'SettingController');

    // ADMIN PANEL
    Route::resource('admin/tasks', 'Admin\TaskController');
    Route::get('admin/tasks/{id}/export', 'Admin\TaskController@export');
    Route::resource('admin/taskQuestions', 'Admin\TaskQuestionController');
    Route::resource('admin/taskAnswers', 'Admin\TaskAnswerController');
    Route::resource('admin/members', 'Admin\MemberController');
    Route::resource('admin/roles', 'Admin\RoleController');
    Route::resource('admin/memberAnswers', 'Admin\MemberAnswerController');
    Route::resource('admin/subjects', 'Admin\SubjectController');
    Route::resource('admin/classrooms', 'Admin\ClassroomController');
    Route::resource('admin/classroomDetails', 'Admin\ClassroomDetailController');
    Route::resource('admin/memberTasks', 'Admin\MemberTaskController');
    Route::resource('admin/memberPoints', 'Admin\MemberPointController');
    Route::resource('admin/users', 'Admin\UserController');
});


