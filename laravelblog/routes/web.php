<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Веб-Маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать веб-маршруты для своего приложения. 
| Эти маршруты загружаются провайдером RouteServiceProvider внутри |группы, которая содержит группу связующего программного обеспечения |"web". А теперь создайте что-нибудь замечательное!
|
*/

Route::resource('posts', PostController::class);
Route::get('/', 'App\Http\Controllers\PostController@index')->name('notebook');
Route::post('/posts/store', 'App\Http\Controllers\PostController@store')->name('store');


