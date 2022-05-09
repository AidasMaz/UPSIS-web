<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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

Route::middleware('auth')->group(function(){
    Route::get('/', 'App\Http\Controllers\GroupsController@index');
    Route::get('/about', 'App\Http\Controllers\PagesController@about');
    Route::get('/login', 'App\Http\Controllers\PagesController@login');
    Route::get('/logout', 'App\Http\Controllers\PagesController@logout');


    // Students
    Route::get('groups/{group_id}/students/create', 'App\Http\Controllers\StudentsController@create');
    Route::post('groups/{group_id}/students/store', 'App\Http\Controllers\StudentsController@store');

    Route::post('groups/{group_id}/students/destroyAll', 'App\Http\Controllers\StudentsController@destroyGroupStudents');
    Route::post('groups/{group_id}/students/destroySolutions', 'App\Http\Controllers\StudentsController@destroyGroupSolutions');
    Route::get('/editProfile', function (Request $request) {
        return view('settings.editProfile');
    });

    Route::get('groups/{group_id}/students/{student_id}', 'App\Http\Controllers\StudentsController@show')->name('student');

    Route::get('groups/{group_id}/students/{student_id}/edit', 'App\Http\Controllers\StudentsController@edit');
    Route::post('groups/{group_id}/students/{student_id}/update', 'App\Http\Controllers\StudentsController@update');

    Route::post('groups/{group_id}/students/{student_id}/destroySolutions', 'App\Http\Controllers\StudentsController@destroyStudentSolutions');
    Route::post('groups/{group_id}/students/{student_id}/destroy', 'App\Http\Controllers\StudentsController@destroy');


    // Groups
    Route::get('/dashboardgroups', 'App\Http\Controllers\GroupsController@index');
    Route::get('/groups', 'App\Http\Controllers\GroupsController@openGroups');

    Route::get('groups/create', 'App\Http\Controllers\GroupsController@create');
    Route::post('groups/store', 'App\Http\Controllers\GroupsController@store');

    Route::get('groups/destroyAll', 'App\Http\Controllers\GroupsController@destroyAllGroups');
    Route::get('groups/destroySolutions', 'App\Http\Controllers\GroupsController@destroyAllSolutions');

    Route::get('groups/{group_id}', 'App\Http\Controllers\GroupsController@show')->name('group');

    Route::get('groups/{group_id}/edit', 'App\Http\Controllers\GroupsController@edit');
    Route::post('groups/{group_id}/update', 'App\Http\Controllers\GroupsController@update');

    Route::post('groups/{group_id}/destroy', 'App\Http\Controllers\GroupsController@destroy');


    // Games
    Route::get('/games', 'App\Http\Controllers\GamesController@index');


    // Settings
    Route::get('/settings', 'App\Http\Controllers\SettingsController@index');
    Route::post('/settings/update','App\Http\Controllers\SettingsController@edit');
});
// Route::get('/groupChildren', 'App\Http\Controllers\PagesController@groupChildren');
// Route::get('/groupGameStats', 'App\Http\Controllers\PagesController@groupGameStats');
// Route::get('/childGameStats', 'App\Http\Controllers\PagesController@childGameStats');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

