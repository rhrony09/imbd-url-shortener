<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/download', [FrontendController::class, 'download'])->name('download');
Route::get('/terms-of-service', [FrontendController::class, 'terms_of_service'])->name('terms');
Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('privacy');

Auth::routes();

//Admin Panel
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'as' => 'dashboard.'], function () {
    Route::get('/', [UrlController::class, 'dashboard'])->name('index');

    //users management
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('profile', [UsersController::class, 'user_profile'])->name('users.profile');
    Route::get('users/{id}', [UsersController::class, 'user_show'])->name('users.show');
    Route::post('users/add', [UsersController::class, 'user_add'])->name('users.add');
    Route::post('users/update/info', [UsersController::class, 'user_update_info'])->name('users.update.info');
    Route::post('users/update/password', [UsersController::class, 'user_update_password'])->name('users.update.password');
    Route::post('users/update/pro_pic', [UsersController::class, 'user_update_pro_pic'])->name('users.update.pro.pic');
    Route::get('users/delete/{id}', [UsersController::class, 'user_delete'])->name('users.delete');

    //settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'settings_update'])->name('settings.update');
});

//magic login
Route::get('/magic-login', [UsersController::class, 'magic_login'])->name('magic.login');

//url management
Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
Route::get('/urls/{id}/details', [UrlController::class, 'getUrlDetails'])->name('urls.details');
Route::delete('/urls/{id}', [UrlController::class, 'delete'])->name('urls.delete');

Route::get('{slug}', [UrlController::class, 'redirect'])->name('redirect');
