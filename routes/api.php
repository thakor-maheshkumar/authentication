<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/signup', [LoginController::class, 'register']);
    Route::post('/signin', [LoginController::class, 'login']);
    Route::get('/user', [LoginController::class, 'user']);
    Route::post('/token-refresh', [LoginController::class, 'refresh']);
    Route::post('/signout', [LoginController::class, 'signout']);
});


