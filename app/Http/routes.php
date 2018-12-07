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

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');

Route::get('/', 'PagesController@getHome')->name('home');
Route::get('/berita/listTerbaru','PagesController@getRecentNews')->name('home.news.list');
Route::get('/berita/detail/{id}','PagesController@getDetailNews')->name('home.news.detail');
Route::get('/dokumen','PagesController@getDokumen')->name('home.dokumen');


Route::get('/webgis','PageMapController@getWebGIS')->name('home.webGIS');
Route::get('/map','PageMapController@getRecentMap')->name('home.map.recent');
Route::get('/map/all','PageMapController@getAllMap')->name('home.map.All');
Route::get('/map/png/download/{id}','PageMapController@downloadPNG')->name('home.map.Dpng');
Route::get('/map/pdf/download/{id}','PageMapController@downloadPDF')->name('home.map.Dpdf');


Route::get('/admin/allNews','NewsController@viewAllNews')->name('admin.news.all');
Route::get('/admin/newsDetails/{id}','NewsController@viewDetails')->name('admin.news.details');
Route::get('/admin/inputNewsForm','NewsController@getNewsForm')->name('admin.news.form');
Route::post('/admin/news/submit','NewsController@inputNews')->name('admin.news.submit');
Route::post('/admin/news/delete/{id}','NewsController@deleteNews')->name('admin.news.delete');
Route::get('/admin/news/update/{id}','NewsController@updateNews')->name('admin.news.formUpdate');
Route::post('admin/news/update/{id}','NewsController@update')->name('admin.news.update');


Route::get('/admin/allMaps','PetaController@viewAll')->name('admin.maps.all');
Route::get('/admin/mapsDetails/{id}','PetaController@viewDetails')->name('admin.maps.details');
Route::post('/admin/maps/delete/{id}','PetaController@deleteMaps')->name('admin.maps.delete');
Route::get('/admin/inputMapsForm','PetaController@getMapsForm')->name('admin.maps.form');
Route::post('/admin/maps/submit','PetaController@inputMaps')->name('admin.maps.submit');
Route::get('/admin/maps/update/{id}','PetaController@updateMaps')->name('admin.maps.formUpdate');
Route::post('admin/maps/update/{id}','PetaController@update')->name('admin.maps.update');


Route::auth();

Route::get('/admin/home', 'AdminController@index')->name('admin.home');
