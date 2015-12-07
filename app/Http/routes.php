<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/auth/login', ['uses' => 'Front\AuthController@login']);
Route::post('/auth/login', ['uses' => 'Front\AuthController@postLogin']);

Route::get('/register', ['uses' => 'Front\AuthController@register']);
Route::post('/register', ['uses' => 'Front\AuthController@postRegister']);

Route::get('/', ['uses' => 'Front\ArticleController@index']);
