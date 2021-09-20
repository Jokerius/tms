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

Route::group(['middleware' => ['AuthCheck']], function () {
    Route::resource('key', 'KeyController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);

    Route::get('language',[
        'uses' => 'LanguageController@index'
    ]);

    Route::post('translation/update', [
        'uses' => 'TranslationController@update'
    ]);

    Route::get('export',[
        'uses' => 'TranslationController@index'
    ]);
});