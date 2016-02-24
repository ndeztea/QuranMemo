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

Route::get('mushaf/generate', 'MushafController@generate');

Route::get('mushaf/', 'MushafController@index');
Route::get('mushaf/page', 'MushafController@index');
Route::get('mushaf/page/{page}', 'MushafController@index');
Route::get('mushaf/page/{page}/{autoplay}', 'MushafController@index');
Route::get('mushaf/changeSurah/{surah}', 'MushafController@changeSurah');
Route::get('mushaf/surah/{surah}', 'MushafController@changeSurah');
Route::get('mushaf/surah/{surah}/{idsurah}', 'MushafController@surah');
Route::post('mushaf/search', 'MushafController@search');


Route::get('notes/', 'NotesController@index');

Route::get('memoz/', 'MemozController@index');
Route::post('memoz/', 'MemozController@index');
//Route::get('memoz/create', ['middleware' => 'auth'],'MemozController@create');

Route::get('bookmarks/', 'BookmarksController@index');

Route::get('auth/login', 'Auth\AuthController@login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('memoz/create', 'MemozController@create');
    Route::get('notes/create', 'NotesController@create');

});







