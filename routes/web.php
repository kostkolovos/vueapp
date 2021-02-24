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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homevue', [App\Http\Controllers\HomeVueController::class, 'index'])->name('homevue');
Route::get('/page', [App\Http\Controllers\HomeVueController::class, 'page'])->name('page');

/*User Routes*/
Route::get('/users', [App\Http\Controllers\Users\UserController::class, 'list'])->name('users');
Route::get('/usersfetch', [App\Http\Controllers\Users\UserController::class, 'usersfetch'])->name('users');

Route::group(['prefix' => 'user'], function () {
    Route::patch('edit', [App\Http\Controllers\Users\UserController::class, 'editProfile']);
    Route::post('new', [App\Http\Controllers\Users\UserController::class, 'createProfile']);
    Route::delete('{id}', [App\Http\Controllers\Users\UserController::class, 'deleteProfile']);
});
/*User Routes*/

/*Question Category Routes*/
Route::get('/question_category', [App\Http\Controllers\Question\QuestionCategory::class, 'list'])->name('questionCategory');
Route::get('/question_category_fetch', [App\Http\Controllers\Question\QuestionCategory::class, 'questionCategoryFetch'])->name('questionCategoryFetch');

Route::group(['prefix' => 'question_category'], function () {
    Route::patch('edit', [App\Http\Controllers\Question\QuestionCategory::class, 'editCategory']);
    Route::post('new', [App\Http\Controllers\Question\QuestionCategory::class, 'createCategory']);
    Route::delete('{id}', [App\Http\Controllers\Question\QuestionCategory::class, 'deleteCategory']);
});
/*Question Category Routes*/

/*Question Routes*/
Route::get('/question', [App\Http\Controllers\Question\Question::class, 'list'])->name('questionCategory');
Route::get('/question_fetch', [App\Http\Controllers\Question\Question::class, 'questionFetch'])->name('questionFetch');

Route::group(['prefix' => 'question'], function () {
    Route::patch('edit', [App\Http\Controllers\Question\Question::class, 'editQuestion']);
    Route::post('new', [App\Http\Controllers\Question\Question::class, 'createQuestion']);
    Route::delete('{id}', [App\Http\Controllers\Question\Question::class, 'deleteQuestion']);
});
/*Question Routes*/
