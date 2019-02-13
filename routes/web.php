<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search');
