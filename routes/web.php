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


Route::get('/', 'MarkController@index')->name('index');
Route::get('/addmodel', 'CarmodelController@add')->name('addmodel');
Route::get('/getmodels/{name}/{desc?}', 'CarmodelController@get')->name('getmodels');
Route::get('/getproducts/{model}', 'ProductController@get')->name('getproducts');
Route::post('/createmodel', 'CarmodelController@save')->name('createmodel');
Route::post('/createproduct', 'ProductController@save')->name('createproduct');
Route::get('/addprod', 'ProductController@add')->name('addprod');
Route::get('/products/{marka}/{model}', 'ProductController@show')->name('showprod');
Route::put('/editname', 'ProductController@editname')->name('editname');
Route::get('/getname/{id}', 'ProductController@getname')->name('getname');

Route::get('/adddesc', 'DescriptionController@add')->name('add');
Route::get('/getdesc/{desc_id}', 'DescriptionController@get')->name('getdesc');
Route::get('/products/{marka}/{model}/{id}/{desc_id}', 'DescriptionController@edit')->name('edit');
Route::put('/update/product/{desc_id}', 'DescriptionController@update')->name('update');
Route::delete('/delete/product/{desc_id}', 'DescriptionController@delete')->name('delete');
Route::post('/products/{marka}/{model}/{id}', 'DescriptionController@save')->name('create');
Route::get('/products/{marka}/{model}/{id}', 'DescriptionController@show')->name('show');

Route::get('/prodlist', 'ProductController@list')->name('prodlist');
Route::get('/deleteprod', 'ProductController@deleteprod')->name('deleteprod');
Route::post('/deleteprod', 'ProductController@detach')->name('detach');
Route::get('/removeprod', 'ProductController@removeprod')->name('removeprod');
Route::delete('/removeprod/{id}', 'ProductController@remove')->name('remove');