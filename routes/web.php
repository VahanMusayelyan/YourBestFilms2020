<?php

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

Route::get('/', 'Site\FilmsController@index')->name("main");
Route::get('/film/{id}', 'Site\FilmsController@show');



Auth::routes();





Route::group(['prefix' => '/admin',], function() {
Route::get('/', 'Dashboard\MainController@index')->name('admin');
Route::any('/auth', 'Dashboard\LoginController@index');
Route::any('/login', 'Dashboard\LoginController@login');
Route::any('/logout', 'Dashboard\LoginController@logout');

});

Route::group(['prefix' => '/admin', ], function() {
Route::resource('/film', 'Dashboard\FilmController');
Route::resource('/country', 'Dashboard\CountryController');
Route::resource('/category', 'Dashboard\CategoryController');
Route::resource('/news', 'Dashboard\NewsController');
Route::get('/film/filter/{filter}/{type}', 'Dashboard\FilmController@filter');

});


Route::any('/login', 'Site\LoginController@login');


Route::any('/registration', 'Site\RegisterController@index');




Route::get('/random', 'Site\FilmsController@random');
Route::get('/top', 'Site\FilmsController@topfilms');
Route::get('/new', 'Site\FilmsController@newfilms');
Route::get('/news', 'Site\NewsController@index');
Route::get('/logout', 'Site\LoginController@logout');
Route::get('/profile', 'Site\ProfileController@index')->name("profile");;
Route::post('/profile/update', 'Site\ProfileController@update');


Route::post('/film/ajax_like', 'Site\LikeDislikeAjaxController@like');
Route::post('/film/ajax_watch', 'Site\WatchAjaxController@watch');
Route::post('/film/ajax_later', 'Site\LaterAjaxController@later');
Route::any('/list', 'Site\ListController@listsecond');
Route::any('/filter', 'Site\FilterController@filter');
Route::any('/search', 'Site\SearchController@search');
Route::post('/film/{id}/comment', 'Site\CommentController@index');






















