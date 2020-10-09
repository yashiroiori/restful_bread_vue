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

Route::post('/login', 'Auth\LoginController@login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 *  Customer BREAD
 */
//MvieiaMfy7NyrSRLql8hYJxWycLDVEJ4NtNqkGOK
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customer', 'CustomerController@index');
    Route::post('/customer', 'CustomerController@store');
});