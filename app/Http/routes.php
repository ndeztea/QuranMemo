<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('mushaf');
});

Route::get('note/manage', ['middleware' => 'auth', function () {
    //
}]);

Route::get('home', 'HomeController@index');


Route::get('mushaf/generate', 'MushafController@generate');
Route::get('mushaf/juz', 'MushafController@juz');
Route::get('mushaf/filter_surah', 'MushafController@filter_surah');
Route::get('mushaf/jump_page', 'MushafController@jump_page');
Route::get('mushaf/start', 'MushafController@index');
Route::get('mushaf/juz/{juz}', 'MushafController@juzPage');
Route::get('mushaf/', 'MushafController@index');
Route::get('mushaf/page', 'MushafController@index');
Route::get('mushaf/page/{page}', 'MushafController@index');
Route::get('mushaf/page/{page}/{autoplay}', 'MushafController@index');
Route::get('mushaf/changeSurah/{surah}', 'MushafController@changeSurah');
Route::get('mushaf/surah/{surah}', 'MushafController@changeSurah');
Route::get('mushaf/surah/{surah}/{idsurah}', 'MushafController@surah');
Route::post('mushaf/search', 'MushafController@search');
Route::get('mushaf/search', 'MushafController@search');
Route::get('mushaf/searchKeyword', 'MushafController@searchKeyword');
Route::get('mushaf/config', 'MushafController@config');
Route::get('mushaf/muqodimah', 'MushafController@muqodimah');
Route::get('mushaf/muqodimah/{idsurah}', 'MushafController@muqodimah');
Route::get('mushaf/set_muratal/{qori}', 'MushafController@set_muratal');


Route::get('notes/', 'NotesController@index');

Route::get('memoz/', 'MemozController@index');
Route::post('memoz/', 'MemozController@index');
Route::get('memoz/surah/{surah}', 'MemozController@index');
Route::get('memoz/surah/{surah}/{idsurah}', 'MemozController@index');
Route::get('memoz/surah/{surah}/{idsurah}/{message}', 'MemozController@index');
Route::post('memoz/search', 'MemozController@search');
Route::get('memoz/search', 'MemozController@search');
Route::get('memoz/config', 'MemozController@config');

//Route::get('memoz/create', ['middleware' => 'auth'],'MemozController@create');

Route::get('bookmarks/', 'BookmarksController@index');

Route::get('contact', 'ContentController@contact');
Route::get('about', 'ContentController@about');
Route::get('donasi', 'ContentController@donasi');
Route::get('buku', 'ContentController@buku');
Route::post('buku', 'ContentController@buku');
Route::get('buku', 'ContentController@buku');
Route::get('tshirt', 'ContentController@tshirt');
Route::get('alkahfi', 'ContentController@alkahfi');
Route::get('migrate', 'ContentController@migrate');


Route::get('promo', 'ContentController@promo');
Route::get('muratal', 'ContentController@muratal');
Route::get('info', 'ContentController@info');
Route::get('store', 'ContentController@store');

Route::get('auth/login', 'Auth\AuthController@login');

Route::get('register', 'RegisterController@index');
Route::post('register/process', 'RegisterController@process');

Route::group(['middleware' => 'auth'], function () {
    Route::get('memoz/create', 'MemozController@create');
    Route::get('notes/create', 'NotesController@create');
    Route::get('notes/create/{surah}/{idsurah}', 'NotesController@create');

    Route::post('notes/save', 'NotesController@save');

});







