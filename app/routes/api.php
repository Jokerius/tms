<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['App\Http\Middleware\AuthCheck']], function () {
    Route::resource('key', 'App\Http\Controllers\KeyController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);

    Route::get('language',[
        'uses' => 'App\Http\Controllers\LanguageController@index'
    ]);

    Route::post('translation/update', [
        'uses' => 'App\Http\Controllers\TranslationController@update'
    ]);

    Route::get('export',[
        'uses' => 'App\Http\Controllers\TranslationController@index'
    ]);
});