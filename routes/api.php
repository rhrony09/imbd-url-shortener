<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/urls', [UrlController::class, 'apiCreate']);
// auth routes
Route::post('/login', [APIController::class, 'login']);
Route::post('/register', [APIController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //magic login
    Route::post('/get-magic-token', [APIController::class, 'get_magic_token']);
    //logout
    Route::post('/logout', [APIController::class, 'logout']);
});
