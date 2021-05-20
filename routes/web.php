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

Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub']);
Route::get('callback/github',[App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);

Route::get('login/gmail', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGmail']);
Route::get('callback/gmail',[App\Http\Controllers\Auth\LoginController::class, 'handleGmailCallback']);

Route::get('/fb', function() {
    $url = 'https://graph.facebook.com/v3.3/4023389834405889/picture?width=1920&access_token=EABNFJjr0gZCMBAGAQlsV2s1RB6R06NmyWcQyPX5mKVq2B7AeycpZAxPjFCIq2wLNmXSQfic14XwKUOs4OU06XDoRR8wpuZAPbf8mBEfl7JZBwljyX93XAGkQKbmnLxl6OqQeveBUh9uQxtPRDtOTEZBvcp3sdHdycDucfINpkXAZDZD';
    $image = file_get_contents($url);
    $n = rand(). '.jpg';
    file_put_contents(public_path('img/'.$n), $image);
});
