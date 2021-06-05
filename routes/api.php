<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sha1Controller;
use App\Http\Controllers\Aes256CbcController;
use App\Http\Controllers\ImageUploadController;
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

Route::get('/encryption/list', EncryptionListController::class)->name('encryptionlist');

Route::post('/encryption/aes/256/cbc', Aes256CbcController::class)->name('aes256cbc');

Route::post('/store/image', ImageUploadController::class)->name('imageupload');
