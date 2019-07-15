<?php



Route::get('/', 'Base\IndexController@show')->name('index');
Route::get('/index','Base\IndexController@show')->name('index');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'Auth\LoginController@create')->name('login');
    Route::POST('/login', 'Auth\LoginController@store')->name('login');
    Route::delete('logout', 'Auth\LoginController@logout')->name('logout');
});






