<?php

Route::group(['prefix' => config('fileman.prefix_route'), 'namespace' => 'Dizytech\Fileman\Http\Controllers'], function(){
    Route::get('/', 'FilemanController@index')->middleware('web');
});