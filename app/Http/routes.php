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
Route::get('mushaf/tafsir/{surah}/{idsurah}', 'MushafController@tafsir')->middleware('subscription:tafsir');
Route::post('mushaf/search', 'MushafController@search');
Route::get('mushaf/search', 'MushafController@search');
Route::get('mushaf/searchKeyword', 'MushafController@searchKeyword');
Route::get('mushaf/config', 'MushafController@config');
Route::get('mushaf/search_form', 'MushafController@search_form');

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
Route::get('subscription', 'ContentController@subscription');
Route::get('partners', 'ContentController@partners');
Route::get('faq', 'ContentController@faq');
Route::get('umroh', 'ContentController@umroh');


Route::get('auth/login', 'Auth\AuthController@login');
Route::get('auth/logout', 'Auth\AuthController@logout');
Route::post('auth/loginAction', 'Auth\AuthController@loginAction');
Route::get('auth/forget', 'Auth\AuthController@forget');
Route::post('auth/forgetProcess', 'Auth\AuthController@forgetProcess');

Route::get('register', 'RegisterController@index');
Route::post('register/process', 'RegisterController@process');

Route::get('dashboard','CategoryController@index');
Route::get('profile/top_user', 'ProfileController@top_user');

Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@categoryContent');
Route::get('content/{id}', 'CategoryController@detailContent');
Route::get('generator/content', 'GeneratorController@content');
Route::post('content/search', 'CategoryController@searchContent');


Route::get('memoz/', 'MemozController@index');
Route::post('memoz/', 'MemozController@index');
Route::post('memoz/inProgress', 'MemozController@inProgress');

Route::get('memoz/surah/{surah}', 'MemozController@index');
Route::get('memoz/surah/{surah}/{idsurah}', 'MemozController@index');
Route::get('memoz/surah/{surah}/{idsurah}/{message}', 'MemozController@index');
Route::post('memoz/search', 'MemozController@search');
Route::get('memoz/search', 'MemozController@search');
Route::get('memoz/config', 'MemozController@config');

Route::get('memoz/form/{id}', 'MemozController@form')->middleware('subscription:save_memoz');
Route::post('memoz/form', 'MemozController@form')->middleware('subscription:save_memoz');
Route::post('memoz/save', 'MemozController@save');
Route::get('memoz/murajaah', 'MemozController@list_murajaah_ajax');
Route::post('memoz/murajaah', 'MemozController@list_murajaah_ajax');
Route::get('memoz/list', 'MemozController@listing');
Route::post('memoz/list_ajax', 'MemozController@list_ajax');
Route::post('memoz/list_others_ajax', 'MemozController@list_others_ajax');
Route::post('memoz/list_need_corrections_ajax', 'MemozController@list_need_corrections_ajax');

Route::post('memoz/remove', 'MemozController@remove');
Route::post('memoz/uploadRecorded','MemozController@uploadRecorded');
Route::post('memoz/uploadRecordedMobile/{idMemo}','MemozController@uploadRecordedMobile');//->middleware('subscription:record');
Route::get('memoz/uploadRecordedMobile/{idMemo}','MemozController@uploadRecordedMobile');//->middleware('subscription:record');
Route::post('memoz/uploadRecordedUstadzMobile/{idMemo}','MemozController@uploadRecordedUstadzMobile');
Route::get('memoz/uploadRecordedUstadzMobile/{idMemo}','MemozController@uploadRecordedUstadzMobile');

Route::get('memoz/correction/{surah}/{idsurah}/{idmemo}/{idCorrection}', 'MemozController@index');
Route::get('memoz/correction/{surah}/{idsurah}/{idmemo}', 'MemozController@index');
Route::post('memoz/updateStatus','MemozController@updateStatus');

Route::post('memoz/formCorrection','MemozController@formCorrection');
Route::post('memoz/saveCorrection','MemozController@saveCorrection');
Route::post('memoz/correction/list', 'MemozController@listCorrection');
Route::get('memoz/summary', 'MemozController@summary');
Route::get('memoz/summary/{id_user}', 'MemozController@summary');

Route::get('memoz/create', 'MemozController@create');
//auth pages
Route::group(['middleware' => 'auth'], function () {
  Route::get('profile/detail/{id_user}', 'ProfileController@detail');

    Route::get('content_learning','ContentController@learning');
    Route::get('file_learning/{folder}','ContentController@file_learning');

    Route::get('notes/create', 'NotesController@create');
    Route::get('notes/create/{surah}/{idsurah}', 'NotesController@create');


    Route::post('notes/save', 'NotesController@save');

    Route::post('profile/edit', 'ProfileController@edit');
    Route::post('profile/addPointsManual', 'ProfileController@addPointsManual');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::post('profile/uploadAvatar','ProfileController@uploadAvatar');
    Route::get('subscription/listing', 'SubscriptionsController@listing');
    Route::get('subscription/counter', 'SubscriptionsController@counter');


    Route::get('subscription/order/{level}/{length}', 'SubscriptionsController@order');
    Route::post('subscription/order/{level}/{length}', 'SubscriptionsController@order');
    Route::get('subscription/confirmation/{id}', 'SubscriptionsController@confirmation');
    Route::post('subscription/confirmation/{id}', 'SubscriptionsController@confirmation');
    Route::get('subscription/cancel/{id}', 'SubscriptionsController@cancel');

    Route::get('quiz/form', 'QuizController@form');
    Route::post('quiz/start', 'QuizController@number');
    Route::post('quiz/number', 'QuizController@number');
    Route::get('quiz/number/{number}', 'QuizController@number');
    Route::post('quiz/number/{number}', 'QuizController@number');
    Route::post('quiz/save', 'QuizController@save');
    Route::get('dashboard/setClass', 'DashboardController@setClass');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('subscription/approve/{id}', 'SubscriptionsController@approve');
    Route::get('subscription/notvalid/{id}', 'SubscriptionsController@notvalid');
    Route::post('subscription/notvalid/{id}', 'SubscriptionsController@notvalid');

    Route::get('profile/list', 'ProfileController@listing');
    Route::post('profile/list', 'ProfileController@listing');

    Route::post('profile/updateClass', 'ProfileController@updateClass');

    #Route::get('dashboard/setClass', 'DashboardController@setClass');
});
