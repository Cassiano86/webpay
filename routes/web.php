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

Auth::routes();

Route::get('/',function(){
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/store',[App\Http\Controllers\HomeController::class, 'store'])->name('store');



Route::group(['middleware'              => 'auth', 'prefix'     => 'url'], function(){
    Route::get('/create',['as'          => 'url.create','uses'  => "App\Http\Controllers\urlController@create"]);
    Route::post('/store',['as'          => 'url.store','uses'   => "App\Http\Controllers\urlController@store"]);
    Route::get('/show/{id}',['as'       => 'url.show','uses'    => "App\Http\Controllers\urlController@show"]);
    Route::get('/edit/{id}',['as'       => 'url.edit','uses'    => "App\Http\Controllers\urlController@edit"]);
    Route::put('/update/{id}',['as'     => 'url.update','uses'  => "App\Http\Controllers\urlController@update"]);
    Route::delete('/destroy/{id}',['as' => 'url.destroy','uses' => "App\Http\Controllers\urlController@destroy"]);
    
    Route::post('/refresh',['as'         => 'url.refresh','uses' => "App\Http\Controllers\urlController@refresh"]);
});

Route::fallback(function(){
    return view('not_found');
});
