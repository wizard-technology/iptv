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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/home',  'HomeController@index')->name('home');
        Route::resource('app', 'ApplicationController');
        Route::resource('category', 'CategoreController');
        Route::resource('channel', 'ChannelController');
        Route::delete('app/channel/{id}', 'ApplicationController@deletechannel')->name('appchannel.destroy');
        Route::post('app/channel/{id}', 'ApplicationController@channelappSet')->name('appchannel.insert');
    }
);