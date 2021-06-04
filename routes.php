<?php

Route::group(['prefix' => 'api'], function () {
    Route::post('login', ['uses' => '\Vdomah\JWTAuth\Controllers\AuthController@login']);
    Route::post('refresh', ['uses' => '\Vdomah\JWTAuth\Controllers\AuthController@refresh']);
    Route::post('invalidate', ['uses' => '\Vdomah\JWTAuth\Controllers\AuthController@refresh']);
    Route::post('signup', ['uses' => '\Vdomah\JWTAuth\Controllers\AuthController@signup']);
});
