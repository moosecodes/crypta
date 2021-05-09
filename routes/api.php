<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sha1Controller;
use App\Http\Controllers\Sha256Controller;
use App\Http\Controllers\EncryptionListController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list', EncryptionListController::class);

Route::post('/sha1', Sha1Controller::class)->name('sha1');
Route::post('/sha256', Sha256Controller::class)->name('sha256');
