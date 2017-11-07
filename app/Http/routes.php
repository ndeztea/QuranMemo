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
    return redirect('dashboard');
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
Route::get('mushaf/tafsir/{surah}/{idsurah}', 'MushafController@tafsir')->middleware('subscription:1');
Route::post('mushaf/search', 'MushafController@search');
Route::get('mushaf/search', 'MushafController@search');
Route::get('mushaf/searchKeyword', 'MushafController@searchKeyword');
Route::get('mushaf/config', 'MushafController@config');
Route::get('mushaf/muqodimah', 'MushafController@muqodimah');
Route::get('mushaf/muqodimah/{idsurah}', 'MushafController@muqodimah');
Route::get('mushaf/set_muratal/{qori}', 'MushafController@set_muratal');


Route::get('notes/', 'NotesController@index');

Route::get('bookmarks/', 'BookmarksController@index');

Route::get('contact', 'ContentController@contact');
Route::get('about', 'ContentController@about');
Route::get('donasi', 'ContentController@donasi');
Route::get('buku', 'ContentController@buku');
Route::post('buku', 'ContentController@buku');
Route::get('buku', 'ContentController@buku');
Route::get('promo', 'ContentController@promo');
Route::get('muratal', 'ContentController@muratal');
Route::get('info', 'ContentController@info');
Route::get('info_memoz', 'ContentController@info_memoz');
Route::get('alkahfi', 'ContentController@alkahfi');


Route::get('auth/login', 'Auth\AuthController@login');
Route::get('auth/logout', 'Auth\AuthController@logout');
Route::post('auth/loginAction', 'Auth\AuthController@loginAction');
Route::get('auth/forget', 'Auth\AuthController@forget');
Route::post('auth/forgetProcess', 'Auth\AuthController@forgetProcess');

Route::get('register', 'RegisterController@index');
Route::post('register/process', 'RegisterController@process');

Route::get('dashboard','DashboardController@index');

//auth pages
Route::group(['middleware' => 'auth'], function () {
    Route::get('memoz/', 'MemozController@index');
    Route::post('memoz/', 'MemozController@index');
    Route::post('memoz/inProgress', 'MemozController@inProgress');

	Route::get('memoz/surah/{surah}', 'MemozController@index');
    Route::get('memoz/surah/{surah}/{idsurah}', 'MemozController@index');
    Route::get('memoz/surah/{surah}/{idsurah}/{message}', 'MemozController@index');
    Route::post('memoz/search', 'MemozController@search');
    Route::get('memoz/search', 'MemozController@search');
    Route::get('memoz/config', 'MemozController@config');

    Route::get('memoz/form/{id}', 'MemozController@form');
	Route::post('memoz/form', 'MemozController@form');
	Route::post('memoz/save', 'MemozController@save');
	Route::get('memoz/list', 'MemozController@listing');
    Route::post('memoz/list_ajax', 'MemozController@list_ajax');
    Route::post('memoz/list_others_ajax', 'MemozController@list_others_ajax');
    Route::post('memoz/list_need_corrections_ajax', 'MemozController@list_need_corrections_ajax');

	Route::post('memoz/remove', 'MemozController@remove');
    Route::post('memoz/uploadRecorded','MemozController@uploadRecorded');
    Route::post('memoz/uploadRecordedMobile/{idMemo}','MemozController@uploadRecordedMobile');
    Route::get('memoz/uploadRecordedMobile/{idMemo}','MemozController@uploadRecordedMobile');
    Route::get('memoz/correction/{surah}/{idsurah}/{idmemo}/{idCorrection}', 'MemozController@index');
    Route::get('memoz/correction/{surah}/{idsurah}/{idmemo}', 'MemozController@index');
    Route::post('memoz/updateStatus','MemozController@updateStatus');

    Route::post('memoz/formCorrection','MemozController@formCorrection');
    Route::post('memoz/saveCorrection','MemozController@saveCorrection');
    Route::post('memoz/correction/list', 'MemozController@listCorrection');
    Route::get('memoz/summary', 'MemozController@summary');
   
    Route::get('memoz/create', 'MemozController@create');
    Route::get('notes/create', 'NotesController@create');
    Route::get('notes/create/{surah}/{idsurah}', 'NotesController@create');
    

    Route::post('notes/save', 'NotesController@save');

    Route::post('profile/edit', 'ProfileController@edit');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::post('profile/uploadAvatar','ProfileController@uploadAvatar');

});