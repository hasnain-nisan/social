<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TwitterController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// URL::forceScheme('https');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('auth/twitter', [SocialController::class, 'loginwithTwitter']);
// Route::get('callback/twitter', [SocialController::class, 'cbTwitter']);

Route::get('login/twitter', [App\Http\Controllers\Auth\LoginController::class, 'redirectToTwitter']);
Route::get('callback/twitter',[App\Http\Controllers\Auth\LoginController::class, 'handleTwitterCallback']);

Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook']);
Route::get('callback/facebook',[App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);
