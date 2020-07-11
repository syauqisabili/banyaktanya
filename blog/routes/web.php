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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('/pertanyaan');
// });


Route::group(['middleware' => ['auth']], function () {

    /**
     * 1 Paket CRUD meliputi
     * GET      /pertanyaan             .index
     * POST     /pertanyaan             .store
     * GET      /pertanyaan/create      .create
     * GET      /pertanyaan/{id}        .show
     * PUT      /pertanyaan/{id}        .update
     * DELETE   /pertanyaan/{id}        .destroy
     * GET      /pertanyaan/{id}/edit   .edit
     */
    Route::resource('/user', 'UserController');
    Route::resource('/pertanyaan', 'PertanyaanController');
    Route::resource('/jawaban', 'JawabanController');
    Route::resource('/komentar', 'KomentarController');
});
