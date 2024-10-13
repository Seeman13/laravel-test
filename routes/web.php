<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
});

Route::group(['namespace' => 'App\\Http\\Controllers\\'], static function () {
    Route::get('catalog/{brand:alias?}', ['uses' => 'CatalogController@index', 'as' => 'catalog']);
});
