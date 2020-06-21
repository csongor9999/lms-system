<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/{role}/{id}', 'HomeController@viewProfile')->name('profile');
    Route::get('/subject/add', 'SubjectController@index')->name('subject.add');
    Route::post('/subject/add', 'SubjectController@store')->name('subject.store');
    Route::get('/subject/publish/{id}', 'SubjectController@publish')->name('subject.publish');
    Route::get('/subject/details/{id}', 'SubjectController@details')->name('subject.details');
    Route::get('/subject/delete/{id}', 'SubjectController@delete')->name('subject.delete');
    Route::get('/subject/edit/{id}', 'SubjectController@edit')->name('subject.edit');
    Route::post('/subject/update/{id}', 'SubjectController@update')->name('subject.update');
    Route::get('/subject/enroll', 'SubjectController@enroll')->name('subject.enroll');
    Route::get('/subject/enroll/{id}', 'SubjectController@enrollStudent')->name('subject.enrollstudent');
    Route::get('/subject/remove/{id}', 'SubjectController@cancelSubject')->name('subject.cancel');
    Route::get('/task/create/{id}', 'TaskController@create')->name('task.create');
    Route::post('/task/store/{id}', 'TaskController@store')->name('task.store');
    Route::get('/task/details/{id}', 'TaskController@details')->name('task.details');
    Route::get('/task/edit/{id}', 'TaskController@edit')->name('task.edit');
    Route::get('/task/solve/{id}', 'TaskController@solve')->name('task.solve');
    Route::post('/task/solve/{id}', 'TaskController@solveTask')->name('task.solvetask');
    Route::post('/task/edit/{id}', 'TaskController@editTask')->name('task.edittask');
    Route::get('/task/list', 'TaskController@list')->name('task.list');
    Route::get('/solution/rate/{id}', 'SolutionController@rate')->name('solution.rate');
    Route::post('/solution/rate/{id}', 'SolutionController@rateSolution')->name('solution.ratesolution');
    Route::get('/solution/download/{filename}', 'SolutionController@download')->name('solution.download');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'HomeController@guest')->name('guest');
});

Auth::routes();