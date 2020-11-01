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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('settings', 'SettingAPIController');

Route::resource('tasks', 'TaskAPIController');

Route::resource('task_questions', 'TaskQuestionAPIController');

Route::resource('task_answers', 'TaskAnswerAPIController');

Route::resource('members', 'MemberAPIController');

Route::resource('member_roles', 'MemberRoleAPIController');

Route::resource('member_answers', 'MemberAnswerAPIController');

Route::resource('subjects', 'SubjectAPIController');

Route::resource('classrooms', 'ClassroomAPIController');

Route::resource('classroom_details', 'ClassroomDetailAPIController');

Route::resource('member_tasks', 'MemberTaskAPIController');

Route::resource('member_points', 'MemberPointAPIController');

Route::resource('users', 'UserAPIController');